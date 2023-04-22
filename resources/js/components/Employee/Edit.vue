<template>
  <div class="editEmployee">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_employee'}">Employee</router-link></li>
              <li class="breadcrumb-item active">Update Employee</li>
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
                <h3 class="card-title">Update Employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="updateEmployee">

                <div class="card-body">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="name">Name</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.name" id="name" placeholder="Name">
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
                      <label class="input-group-text" for="Salary">Salary</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.salary" id="Salary" placeholder="Salary">
                  </div>
                  <small class="text-red" v-if="errors.salry">{{ errors.salary[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="address">Address</label>
                    </div>
                    <textarea type="text" class="form-control" rows="3" v-model="form.address" id="address" placeholder="Address"></textarea>
                  </div>
                  <small class="text-red" v-if="errors.address">{{ errors.address[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="nid">NID</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.nid" id="nid" placeholder="NID">
                  </div>
                  <small class="text-red" v-if="errors.nid">{{ errors.nid[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="joining_date">Joining Date</label>
                    </div>
                    <input  type="date" class="form-control" v-model="form.joining_date" id="joining_date">
                  </div>

                  <small class="text-red" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>

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
                    <input type="submit" class="btn btn-success btn-sm" value="Update Employee">
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
  name: "Edit",
  data(){
    return {
      form: {
        name: null,
        email: null,
        phone: null,
        salary: null,
        address: null,
        nid: null,
        photo: null,
        new_photo: null,
        joining_date: null,
      },
      errors: {}
    }
  },
  created() {
    this.authentication();
    this.getEmployee()
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

    getEmployee(){
      axios.get('/employee/' + this.$route.params.id)
          .then(response => {
            this.form = response.data
          }).catch(error => {
      })
    },
    imagePath(value){
      return value ?  '/'+value : null
    },
    updateEmployee(){
      axios.put('/employee/' + this.$route.params.id, this.form)
          .then(response => {
            this.$router.push({
              name: 'list_employee'
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