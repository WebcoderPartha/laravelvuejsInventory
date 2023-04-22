<template>
  <div class="listSupplier">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Supplier List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_supplier'}">Supplier</router-link></li>
              <li class="breadcrumb-item active">Supplier List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'add_supplier'}">Add Supplier</router-link>
                </h3>
                <br><br>
                <div class="row">
                  <div class="col-md-4 mx-auto">
                    <!--                      <form @submit.prevent="SearchEmployee">-->
                    <div class="input-group">
                      <input type="text" class="form-control" v-model="search_keyword" placeholder="Search supplier">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                      </div>
                    </div>
                    <!--                      </form>-->
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Shop Name</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(supplier, index) in SearchSupplier" :key="supplier.id">
                    <td>{{ index+1 }}</td>
                    <td>{{supplier.name }}</td>
                    <td>{{supplier.email }}</td>
                    <td>{{supplier.phone }}</td>
                    <td>{{supplier.address }}</td>
                    <td>{{supplier.shop_name ? supplier.shop_name : '' }}</td>
                    <td><img :src="imagePath(supplier.photo)" width="40" alt=""></td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'edit_supplier', params:{id:supplier.id}}"><i class="fa fa-edit"></i></router-link>
                      || <button @click.prevent="deleteAction(supplier.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
export default {
  name: "SupplierList",
  created() {
    this.authentication();
    this.getSupplier()
  },
  computed:{
    SearchSupplier(){
      return this.suppliers = this.suppliers.filter(supplier => {
        if (supplier.name.match(this.search_keyword)){
          return supplier.name.match(this.search_keyword)
        }else if(supplier.phone.match(this.search_keyword)){
          return supplier.phone.match(this.search_keyword)
        }else if(supplier.email.match(this.search_keyword)){
          return supplier.email.match(this.search_keyword)
        }
        axios.get('/supplier').then(response => {
          this.suppliers = response.data;
        })
      })
    }
  },
  data(){
    return {
      suppliers: [],
      search_keyword: ''
    }
  },
  methods:{
    authentication(){
      if (!User.authenticate()){
        return this.$router.push({
          name: 'login'
        });
      }
    },
    getSupplier(){
      axios.get('/supplier').then(response => {
        this.suppliers = response.data;
      }).catch(error => {

      })
    },
    deleteAction(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/supplier/'+id).then(response => {
            this.suppliers = this.suppliers.filter(supplier => {
              return supplier.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              'Supplier has been deleted.',
              'success'
          )
        }
      })
    },
    imagePath(value){
      return value ?  '/'+value : null
    },
  }
}
</script>

<style scoped>

</style>