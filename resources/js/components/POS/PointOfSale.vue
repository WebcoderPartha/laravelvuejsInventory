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
                      <tr class="productRow" v-for="product in products" :key="product.id">
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
                      <tr class="productRow" v-for="catProduct in catProducts" :key="catProduct.id">
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

                  </div>
                </div>

              </div><!-- /.card-body -->

            </div> <!-- /.card -->
          </div> <!-- /col-md-7 -->
          <!--  /end right column -->
        </div>

        <div class="row">
          <!-- left column -->
          <div class="col-md-10 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">POS</h3>
                <div class="float-right btn btn-info">Add Customer</div>
              </div> <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Name</td>
                    <td>3445</td>
                    <td>34</td>
                    <td>45</td>

                    <td><span class="btn btn-sm btn-danger">X</span></td>
                  </tr>
                  </tbody>
                </table>

              </div><!-- /.card-body -->

            </div> <!-- /.card -->
          </div> <!-- /col-md-5 -->
          <!--  /end left column -->

        </div> <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>

export default {
  name: "PointOfSale",
  data(){
    return {
      form: {
      },
      products: [],
      categories: [],
      catProducts: []
    }
  },
  created() {
    this.getCategory();
    this.getCatByIdProducts();
    this.getProduct();
  },
  computed: {

  },
  methods: {
    getCategory(){
      axios.get('/category').then(response => this.categories = response.data)
    },
    getCatByIdProducts(catID){
      axios.get('/catbyidproducts/'+catID).then(res => this.catProducts = res.data)
    },
    getProduct(){
      axios.get('/product').then(res => this.products = res.data)
    },
    dataTarget(value){
      return "#"+value
    },
    imagePath(path){
      return "/"+path
    }
  }
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