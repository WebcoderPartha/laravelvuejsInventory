<template>
  <div class="editEmployee">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Product Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'stock_products'}">Stock Product</router-link></li>
              <li class="breadcrumb-item active">Update Stock Product</li>
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
                <h3 class="card-title">Update Stock</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="updateData">

                <div class="card-body">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="product_code">Product Code</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.product_code" id="product_code" disabled>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="product_name">Product Name</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.product_name" id="product_name" disabled>
                  </div>


                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="quantity">Quantity</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.quantity" id="quantity" placeholder="Quantity">
                  </div>
                  <small class="text-red" v-if="errors.quantity">{{ errors.quantity[0] }}</small>




                  <div class="input-group mb-3">
                    <input type="submit" class="btn btn-success btn-sm" value="Update Stock">
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
export default {
  name: "StockUpdate",
  data(){
    return {
      form: {
        product_name: null,
        product_code: null,
        quantity: null,
      },
      errors: {}
    }
  },
  created() {
    this.authentication();
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

    getProduct(){
      axios.get('/product/' + this.$route.params.id)
          .then(response => {
            this.form = response.data
          }).catch(error => {
      })
    },

    updateData(){
      axios.post('/stock-update/' + this.$route.params.id, this.form)
          .then(response => {
            this.$router.push({
              name: 'stock_products'
            });
            Notification.success(response.data)
          }).catch(error => {
            if (error.response.data.errors.quantity[0]){
              Notification.error(error.response.data.errors.quantity[0])
            }
      })
    }
  }
}
</script>

<style scoped>

</style>