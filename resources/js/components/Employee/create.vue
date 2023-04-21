<template>
  <div class="addEmployee">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_employee'}">Employee</router-link></li>
              <li class="breadcrumb-item active">Add Employee</li>
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
                <h3 class="card-title">Add Employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="">

                <div class="card-body">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="name">Name</label>
                    </div>
                    <input type="text" class="form-control" v-model="this.form.name" id="name" placeholder="Name">
                  </div>
                  <small v-if="this.errors.name">{{ this.errors.name[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="email">Email</label>
                    </div>
                    <input type="email" class="form-control" v-model="form.email" id="email" placeholder="Email">
                  </div>
                  <small v-if="this.errors.email">{{ this.errors.email[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="Phone">Phone</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.phone" id="Phone" placeholder="Phone">
                  </div>
                  <small v-if="this.errors.phone">{{ this.errors.phone[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="Salary">Salary</label>
                    </div>
                    <input type="text" class="form-control" v-model="form.salary" id="Salary" placeholder="Salary">
                  </div>
                  <small v-if="this.errors.salry">{{ this.errors.salary[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="address">Address</label>
                    </div>
                    <textarea type="text" class="form-control" rows="3" v-model="form.address" id="address" placeholder="Address"></textarea>
                  </div>
                  <small v-if="this.errors.address">{{ this.errors.address[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="nid">NID</label>
                    </div>
                    <input type="text" class="form-control" rows="3" v-model="form.nid" id="nid" placeholder="NID">
                  </div>
                  <small v-if="this.errors.nid">{{ this.errors.nid[0] }}</small>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="joining_date">Joining Date</label>
                    </div>
                    <input type="date" class="form-control" rows="3" v-model="form.joining_date" id="joining_date">
                  </div>
                  <small v-if="this.errors.joining_date">{{ this.errors.joining_date[0] }}</small>

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
                    <input type="submit" class="btn btn-success btn-sm" value="Add Employee">
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
  name: "create",
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
        joining_date: null,
      },
      errors: {}
    }
  },
  methods: {
    uploadImage(e){
      let file = e.target.files[0];
      // console.log(file.size)
      if (file.size < 1048576 ){
        const reader = new FileReader();
        reader.onload = (event) => {
          this.form.photo = event.target.result
          document.getElementById('showImage').src = event.target.result
          console.log(this.form.photo)
        };
        reader.readAsDataURL(file);
      }else{
        Notification.error('Image file must be less than 1 MB')
      }
    }
  }
}
</script>

<style scoped>

</style>