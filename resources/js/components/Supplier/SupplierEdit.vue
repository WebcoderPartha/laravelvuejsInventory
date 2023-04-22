<template>
  <div class="editSupplier">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_supplier'}">Supplier</router-link></li>
              <li class="breadcrumb-item active">Update Supplier</li>
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
                <h3 class="card-title">Update Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="updateData" >

                <div class="card-body">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="name">Name</label>
                    </div>
                    <input type="text" class="form-control" autocomplete="off" v-model="form.name" id="name" placeholder="Name">
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
                      <label class="input-group-text" for="Phone">Phone</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.phone" id="Phone" placeholder="Phone">
                  </div>
                  <small class="text-red" v-if="errors.phone">{{ errors.phone[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="address">Address</label>
                    </div>
                    <textarea type="text" class="form-control" rows="3" v-model="form.address" id="address" placeholder="Address"></textarea>
                  </div>
                  <small class="text-red" v-if="errors.address">{{ errors.address[0] }}</small>


                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="shop_name">Shop Name</label>
                    </div>
                    <input  type="text" class="form-control" v-model="form.shop_name" id="shop_name">
                  </div>
                  <small class="text-red" v-if="errors.shop_name">{{ errors.shop_name[0] }}</small>

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
                    <input type="submit" class="btn btn-success btn-sm" value="Update Supplier">
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
  name: "SupplierEdit",
  data(){
    return {
      form: {
        name: null,
        email: null,
        phone: null,
        address: null,
        shop_name: null,
        photo: null,
        new_photo: null
      },
      errors: {}
    }
  },
  created() {
    this.authentication();
    this.getSupplier()
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

    getSupplier(){
      axios.get('/supplier/' + this.$route.params.id)
          .then(response => {
            this.form = response.data
          }).catch(error => {
      })
    },
    imagePath(value){
      return value ?  '/'+value : null
    },
    updateData(){
      axios.put('/supplier/' + this.$route.params.id, this.form)
          .then(response => {
            this.$router.push({
              name: 'list_supplier'
            });
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