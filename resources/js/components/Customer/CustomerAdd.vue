<template>
  <div class="addProduct">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_customer'}">Customer</router-link></li>
              <li class="breadcrumb-item active">Add Customer</li>
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
                <h3 class="card-title">Add Customer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="storeData">

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

                  <div class="input-group mb-3">
                    <input type="submit" class="btn btn-success btn-sm" value="Add Customer">
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
  name: "CustomerAdd",
  data(){
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        photo: ''
      },
      errors: {}
    }
  },
  created() {
    this.authentication();
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
          this.form.photo = event.target.result
          document.getElementById('showImage').src = event.target.result
        };
        reader.readAsDataURL(file);
      }else{
        Notification.error('Image file must be less than 1 MB')
      }
    },

    storeData(){
      axios.post('/customer', this.form)
          .then(response => {
            this.$router.push({name:'list_customer'})
            Notification.success(response.data)
          }).catch(error => {
        this.errors = error.response.data.errors
      })
    }
  }
}
</script>
<style scoped>

</style>