<template>
  <div class="POS">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>POS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
              <li class="breadcrumb-item active">Point Of Sale</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">


        <div class="row">
          <!-- right column -->
          <div class="col-md-10 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                Category Wise Product
              </div> <!-- /.card-header -->
              <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All</button>
                  </li>
                  <li class="nav-item" v-for="category in categories" :key="category.id" role="presentation">
                    <button class="nav-link" @click="getCatByIdProducts(category.id)" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                      {{ category.name }}</button>
                  </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <!-- Search -->
                      <div class="input-group mt-2 mb-2">
                        <input type="text" v-model="SearchAll" class="form-control" placeholder="Search">
                        <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-search"></i>
                      </span>
                        </div>
                      </div>
                    <!-- /Search -->

                    <table class="table table-bordered">
                      <thead>
                      <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Image</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr class="productRow" v-for="product in AllProductFilter" @click.prevent="addToCart(product.id)" :key="product.id">
                        <td>{{ product.product_code }}</td>
                        <td>{{ product.product_name }}</td>
                        <td>
                          <span class="badge badge-danger" v-if="product.quantity === '0'">Stock Out ({{ product.quantity }})</span>
                          <span class="badge badge-info" v-else>Available ({{ product.quantity }})</span>
                        </td>
                        <td>{{ product.selling_price }}</td>
                        <td><img class="productImage" :src="imagePath(product.photo)" alt=""></td>
                      </tr>
                      </tbody>
                    </table>

                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Search -->
                    <div class="input-group mt-2 mb-2"  v-if="catProducts.length > 0">
                      <input type="text" v-model="CatWiseSeach" class="form-control" placeholder="Search">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-search"></i>
                      </span>
                      </div>
                    </div>
                    <!-- /Search -->

                    <table class="table table-bordered" v-if="catProducts.length > 0">
                      <thead>
                      <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Image</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr class="productRow" v-for="catProduct in CatWiseProductFilter" @click.prevent="addToCart(catProduct.id)" :key="catProduct.id">
                        <td>{{ catProduct.product_code }}</td>
                        <td>{{ catProduct.product_name }}</td>
                        <td>
                          <span class="badge badge-danger" v-if="catProduct.quantity === '0'">Stock Out ({{ catProduct.quantity }})</span>
                          <span class="badge badge-info" v-else>Available ({{ catProduct.quantity }})</span>
                        </td>
                        <td>{{ catProduct.selling_price }}</td>
                        <td><img class="productImage" :src="imagePath(catProduct.photo)" alt=""></td>
                      </tr>
                      </tbody>
                    </table>
                    <h4 class="text-center mt-1" v-else>No product found!</h4>

                  </div>
                </div>

              </div><!-- /.card-body -->

            </div> <!-- /.card -->
          </div> <!-- /col-md-7 -->
          <!--  /end right column -->
        </div>

        <cart @deleteCart="removeItem"  :getCartData="getCartData"></cart>

        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="row">
              <div class="col-md-6">

               <div class="card">
                 <div class="card-body">
                   <form action="">

                     <div class="form-group">
                       <label for="customers">Customer</label>
                       <select class="form-control" id="customers">
                         <option value="">Select Customer</option>
                         <option :value="get_customer.id" v-for="get_customer in get_customers" :key="get_customer.id" >{{ get_customer.name }}</option>
                       </select>
<!--                       <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>-->
                     </div>
                     <div class="form-group">
                       <label for="Advance">Advance Pay</label>
                       <input type="text" class="form-control" id="Advance" placeholder="Advance pay">
<!--                       <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>-->
                     </div>
                     <div class="form-group">
                       <label for="Due">Due</label>
                       <input type="text" class="form-control" id="Due" placeholder="Due">
                       <!--                       <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>-->
                     </div>
                     <div class="form-group">
                       <label for="payby">Pay By</label>
                       <select class="form-control" id="payby">
                         <option value="">Select</option>
                         <option value="Cash">Cash</option>
                         <option value="Cheque">Cheque</option>
                       </select>
                       <!--                       <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>-->
                     </div>

                   </form>
                 </div>
               </div>

              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <ul class="list-group">
                      <li class="list-group-item">Total Quantity: <span class="float-right">345</span></li>
                      <li class="list-group-item">Sub Total: <span class="float-right">345</span></li>
                      <li class="list-group-item">Vat: <span class="float-right">345</span></li>
                      <li class="list-group-item">Total: <span class="float-right">345</span></li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="customer" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="form">
            <div class="modal-header">
              <h5 class="modal-title">Add Customer</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


                <div class="card-body">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="name">Customer Name</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.name" id="name" placeholder="Customer name">
                  </div>
                  <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="email">Email</label>
                    </div>
                    <input type="email" class="form-control" v-model="form.email" id="email" placeholder="Email">
                  </div>
                  <small class="text-red" v-if="errors.email">{{ errors.email[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="phone">Phone</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.phone" id="phone" placeholder="Customer phone">
                  </div>
                  <small class="text-red" v-if="errors.phone">{{ errors.phone[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="address">Address</label>
                    </div>
                    <textarea class="form-control" v-model="form.address" rows="3" id="address" placeholder="Customer address"></textarea>
                  </div>
                  <small class="text-red" v-if="errors.address">{{ errors.address[0] }}</small>



                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="photo">Photo</label>
                        </div>
                        <input type="file" class="form-control" @change.prevent="uploadImage" id="photo">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <img src="" id="showImage" width="200" alt="">
                    </div>

                  </div>

                </div>     <!-- /.card-body -->


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal" @click.prevent="storeData">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    
  </div>
</template>

<script>

import Cart from "./Cart.vue";
export default {
  name: "PointOfSale",
  data(){
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        photo: ''
      },
      SearchAll: '',
      CatWiseSeach: '',
      errors: {},
      products: [],
      categories: [],
      catProducts: [],
      get_customers: [],
      getCartData: []
    }
  },
  created() {
    this.getCategory();
    this.getCatByIdProducts();
    this.getProduct();
    this.getCustomer();
    this.getCarts();
  },
  computed: {
    AllProductFilter(){
       return this.products = this.products.filter(product => {
        if (product.product_name.match(this.SearchAll)){
         return  product.product_name.match(this.SearchAll);
        }
        else if (product.product_code.match(this.SearchAll)){
           return  product.product_code.match(this.SearchAll);
         }
        axios.get('/getallproduct').then(res => this.products = res.data)
      })
    },
    CatWiseProductFilter(){
      return this.catProducts = this.catProducts.filter(catProduct => {
        if (catProduct.product_name.match(this.CatWiseSeach)){
          return  catProduct.product_name.match(this.CatWiseSeach);
        }
        else if (catProduct.product_code.match(this.CatWiseSeach)){
          return  catProduct.product_code.match(this.CatWiseSeach);
        }
        axios.get('/product').then(res => this.catProducts = res.data)
      })
    }
  },
  components: {
    Cart
  },
  methods: {
    getCategory(){
      axios.get('/category').then(response => this.categories = response.data)
    },
    getCatByIdProducts(catID){
      axios.get('/catbyidproducts/'+catID).then(res => this.catProducts = res.data)
    },
    getProduct(){
      axios.get('/getallproduct').then(res => this.products = res.data)
    },
    dataTarget(value){
      return "#"+value
    },
    imagePath(path){
      return "/"+path
    },

    uploadImage(e){
      let file = e.target.files[0];
      // console.log(file.size)
      if (file.size < 1048576 ){
        const reader = new FileReader();
        reader.onload = (event) => {
          this.form.photo = event.target.result
          document.getElementById('showImage').src = event.target.result
        };
        reader.readAsDataURL(file);
      }else{
        Notification.error('Image file must be less than 1 MB')
      }
    },
    storeData(){
      axios.post('/customer', this.form).then(response => {
        $('#form')[0].reset();
        document.getElementById('showImage').src = ''
        Notification.success(response.data);
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
    getCustomer(){
      axios.get('/customer').then(res => this.get_customers = res.data);
    },
    addToCart(productID){
      axios.post('/addtocart/'+productID).then(response => {
        axios.get('/getcarts').then(res => this.getCartData = res.data)
        Notification.success(response.data)
      })
    },
    getCarts(){
      axios.get('/getcarts').then(response => {
        this.getCartData =  response.data
      })
    },
    removeItem(payload){
      axios.delete('/remove_cart/'+payload.cartID).then(response => {
        axios.get('/getcarts').then(response => {
          this.getCartData = response.data
        })
      })
    }

  },

}
</script>

<style scoped>
.nav-tabs .nav-link {
  border: 0 solid !important;
}
.nav-item button{
  background: transparent;
  color: #fff;
}
.dark-mode .nav-tabs .nav-item.show .nav-link, .dark-mode .nav-tabs .nav-link.active {
  background-color: #3498db;
  color: #fff;
  border: 0 !important;
}
.productImage{
  width: 20px;
}
.productRow{
  cursor: pointer;
}
</style>