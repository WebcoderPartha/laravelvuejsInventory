<template>
  <div class="listCustomer">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_customer'}">Customer</router-link></li>
              <li class="breadcrumb-item active">Customer List</li>
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
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'add_customer'}">Add Customer</router-link>
                </h3>
                <br><br>
                <div class="row">
                  <div class="col-md-4 mx-auto">
                    <!--                      <form @submit.prevent="SearchEmployee">-->
                    <div class="input-group">
                      <input type="text" class="form-control" v-model="search_keyword" placeholder="Search customer">
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
                <table class="table table-bordered" v-if="customers.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(customer, index) in SearchCustomer" :key="customer.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email ? customer.email : ''  }}</td>
                    <td>{{ customer.phone ? customer.phone : ''  }}</td>
                    <td>{{ customer.address ? customer.address : ''  }}</td>
                    <td><img :src="imagePath(customer.photo)" width="40" alt=""></td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'edit_customer', params:{id:customer.id}}"><i class="fa fa-edit"></i></router-link>
                      || <button @click.prevent="deleteEmployee(customer.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <h3 class="text-center" v-else>No data found!</h3>
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
  name: "CustomerList",
  created() {
    this.authentication();
    this.getCustomer()
  },
  computed:{
    SearchCustomer(){
      return this.customers = this.customers.filter(customer => {
        if (customer.name.match(this.search_keyword)){
          return customer.name.match(this.search_keyword)
        }else if(customer.phone.match(this.search_keyword)){
          return customer.phone.match(this.search_keyword)
        }
        axios.get('/customer').then(response => {
          this.customers = response.data;
        })
      })
    }
  },
  data(){
    return {
      customers: [],
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
    getCustomer(){
      axios.get('/customer').then(response => {
        this.customers = response.data;
      }).catch(error => {

      })
    },
    deleteEmployee(id){
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
          axios.delete('/customer/'+id).then(response => {
            return this.customers = this.customers.filter(customer => {
              return customer.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              'Customer has been deleted.',
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