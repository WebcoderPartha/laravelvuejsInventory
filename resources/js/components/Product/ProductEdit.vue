<template>
  <div class="editProduct">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_product'}">Product</router-link></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 mx-auto">
            <!-- general form elements -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="updateData">

                <div class="card-body">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="category_id">Category</label>
                    </div>
                    <select class="form-control" v-model="form.category_id" id="category_id">
                      <option value="">Select Category</option>
                      <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                  </div>
                  <small class="text-red" v-if="errors.category_id">{{ errors.category_id[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="supplier_id">Supplier</label>
                    </div>
                    <select class="form-control" v-model="form.supplier_id" id="supplier_id">
                      <option value="">Select Supplier</option>
                      <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.name }}</option>
                    </select>
                  </div>
                  <small class="text-red" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="product_name">Product Name</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.product_name" id="product_name" placeholder="Product name">
                  </div>
                  <small class="text-red" v-if="errors.product_name">{{ errors.product_name[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="product_code">Product Code</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.product_code" id="product_code" placeholder="Product code">
                  </div>
                  <small class="text-red" v-if="errors.product_code">{{ errors.product_code[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="root">Root</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.root" id="root" placeholder="Root">
                  </div>
                  <small class="text-red" v-if="errors.root">{{ errors.root[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="buying_price">Buying Price</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.buying_price" id="buying_price" placeholder="Buying price">
                  </div>
                  <small class="text-red" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="selling_price">Selling Price</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.selling_price" id="selling_price" placeholder="Selling price">
                  </div>
                  <small class="text-red" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="quantity">Quantity</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.quantity" id="quantity" placeholder="Quantity">
                  </div>
                  <small class="text-red" v-if="errors.quantity">{{ errors.quantity[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="buying_date">Buying Date</label>
                    </div>
                    <input type="date" class="form-control" v-model="form.buying_date" id="buying_date">
                  </div>
                  <small class="text-red" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>


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
                      <img :src="imagePath(form.photo)" id="showImage" width="200" alt="">
                    </div>

                  </div>

                  <div class="input-group mb-3">
                    <input type="submit" class="btn btn-success btn-sm" value="Update Product">
                  </div>

                </div>     <!-- /.card-body -->

              </form>
            </div>
            <!-- /.card -->
            <!-- Horizontal Form -->

            <!-- /.card -->

          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ProductEdit",
  data(){
    return {
      form: {
        category_id: '',
        supplier_id: '',
        product_name: '',
        product_code: '',
        root: '',
        buying_price: '',
        selling_price: '',
        quantity: '',
        buying_date: '',
        photo: '',
        new_photo: ''
      },
      categories: {},
      suppliers: {},
      errors: {}
    }
  },
  created() {
    this.authentication();
    this.getCategory();
    this.getSupplier();
    this.getProduct()
  },
  methods: {
    authentication(){
      if (!User.authenticate()){
        return this.$router.push({
          name: 'login'
        });
      }
    },
    uploadImage(e){
      let file = e.target.files[0];
      // console.log(file.size)
      if (file.size < 1048576 ){
        const reader = new FileReader();
        reader.onload = (event) => {
          this.form.new_photo = event.target.result
          document.getElementById('showImage').src = event.target.result
        };
        reader.readAsDataURL(file);
      }else{
        Notification.error('Image file must be less than 1 MB')
      }
    },

    imagePath(value){
      return value ?  '/'+value : null
    },
    updateData(){
      axios.put('/product/' + this.$route.params.id, this.form)
          .then(response => {
            this.$router.push({
              name: 'list_product'
            });
            Notification.success(response.data)
          }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
    getCategory(){
      axios.get('/category').then(response => {
        this.categories = response.data
      })
    },
    getSupplier(){
      axios.get('/supplier').then(response => {
        this.suppliers = response.data
      })
    },
    getProduct(){
      axios.get('/product/'+this.$route.params.id).then(response=> {
        this.form = response.data
      })
    }
  }
}
</script>
<style scoped>
</style>