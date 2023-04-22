<template>
  <div class="editCategory">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_category'}">Category</router-link></li>
              <li class="breadcrumb-item active">Update Category</li>
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
                <h3 class="card-title">Update Category</h3>
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
                    <input type="submit" class="btn btn-success btn-sm" value="Update Category">
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
  name: "CategoryEdit",
  data(){
    return {
      form: {
        name: null
      },
      errors: {}
    }
  },
  created() {
    this.authentication();
    this.getCategory()
  },
  methods: {
    authentication(){
      if (!User.authenticate()){
        return this.$router.push({
          name: 'login'
        });
      }
    },


    getCategory(){
      axios.get('/category/' + this.$route.params.id)
          .then(response => {
            this.form = response.data
          }).catch(error => {
      })
    },

    updateData(){
      axios.put('/category/' + this.$route.params.id, this.form)
          .then(response => {
            this.$router.push({
              name: 'list_category'
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