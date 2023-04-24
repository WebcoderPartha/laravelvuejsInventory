<template>
  <div class="stockProduct">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stock Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_product'}">List Product</router-link></li>
              <li class="breadcrumb-item active">Stock Product</li>
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
                <table class="table table-bordered" v-if="products.length > 0">
                  <thead>
                  <tr>
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(product, index) in SearchProduct" :key="product.id">
                    <td>{{ product.product_code }}</td>
                    <td>{{product.product_name }}</td>
                    <td>{{product.supplier.shop_name }}</td>
                    <td>{{product.quantity }}</td>
                    <td>

                      <span class="badge badge-danger" v-if="product.quantity === '0'">Stock Out</span>
                      <span class="badge badge-primary" v-else>Available</span>
                    </td>
                    <td><img :src="imagePath(product.photo)" width="40" alt=""></td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'stock_update', params:{id:product.id}}"><i class="fa fa-plus"></i>  Add Quantity</router-link>
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
  name: "StockProduct",
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
    imagePath(path){
      return '/'+path
    }

  }
}
</script>

<style scoped>

</style>