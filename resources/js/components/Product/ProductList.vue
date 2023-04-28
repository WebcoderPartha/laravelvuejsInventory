<template>
  <div class="listProduct">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_product'}">Product</router-link></li>
              <li class="breadcrumb-item active">Product List</li>
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
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'add_product'}">Add Product</router-link>
                </h3>
                <br><br>
                <div class="row">
                  <div class="col-md-4 mx-auto">
                    <!--                      <form @submit.prevent="SearchEmployee">-->
                    <div class="input-group">
                      <input type="text" class="form-control" v-model="search_keyword" placeholder="Search product">
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
                    <th style="width: 10px">Code</th>
                    <th>Name</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Root</th>
                    <th>Quantity</th>
                    <th>Buying Date</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="product in SearchProduct" :key="product.id">
                    <td>{{ product.product_code }}</td>
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.buying_price }}</td>
                    <td>{{ product.selling_price }}</td>
                    <td>{{ product.root }}</td>
                    <td>{{ product.quantity }}</td>
                    <td>{{ product.buying_date }}</td>
                    <td>{{ product.category.name ? product.category.name : '' }}</td>
                    <td>{{ product.supplier.shop_name ? product.supplier.shop_name : ''  }}</td>
                    <td><img :src="imagePath(product.photo)" width="40" alt=""></td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'edit_product', params:{id:product.id}}"><i class="fa fa-edit"></i></router-link>
                      || <button @click.prevent="deleteEmployee(product.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  </tbody>
                </table>
<!--                <h3 class="text-center" v-else>No data found!</h3>-->
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
  name: "ProductList",
  created() {
    this.authentication();
    this.getProduct()
  },
  computed:{
    SearchProduct(){
      return this.products = this.products.filter(product => {
        if (product.product_name.match(this.search_keyword)){
          return product.product_name.match(this.search_keyword)
        }else if(product.product_code.match(this.search_keyword)){
          return product.product_code.match(this.search_keyword)
        }
        axios.get('/product').then(response => {
          this.products = response.data;
        })
      })
    }
  },
  data(){
    return {
      products: [],
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
    getProduct(){
      axios.get('/product').then(response => {
        this.products = response.data;
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
          axios.delete('/product/'+id).then(response => {
            this.products = this.products.filter(product => {
              return product.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              'Product has been deleted.',
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