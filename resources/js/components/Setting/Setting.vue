<template>
  <div class="addCategory">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
              <li class="breadcrumb-item active">Setting</li>
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
                <h3 class="card-title">Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="storeData" >

                <div class="card-body">

                  <div class="closestItem">

                    <div class="row">
                      <div class="col-md-10">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="email">Email</label>
                          </div>
                          <input type="email" class="form-control" autocomplete="off"  v-model="form.email" id="email" placeholder="Email">
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="phone">Phone</label>
                          </div>
                          <input type="text" class="form-control" autocomplete="off"  v-model="form.phone" id="phone" placeholder="Category Name">
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="vat">Vat (%)</label>
                          </div>
                          <input type="text" class="form-control" autocomplete="off"  v-model="form.vat" id="vat" placeholder="Category Name">
                        </div>

                      </div>

                    </div><!--  /end Row -->

                  </div> <!--  /end closestItem -->

                  <div class="input-group mb-3">
                    <input type="submit" class="btn btn-success btn-sm" value="Update Setting">
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
  name: "Setting",
  data(){
    return {
      form: {
        phone: '',
        email: '',
        vat: ''
      },
      errors: ''
    }
  },
  created() {
    this.authentication();
    this.getSetting();
  },
  methods: {
    authentication() {
      if (!User.authenticate()) {
        return this.$router.push({
          name: 'login'
        });
      }
    },
    getSetting(){
      axios.get('/setting').then(res => this.form = res.data)
    },

    storeData() {

      if (!this.validation()) {
        axios.put('/setting/'+this.form.id, this.form)
            .then(response => {
              Notification.success(response.data)
            }).catch(error => {
          this.errors = error.response.data.errors
        })
      }

    },

    validation(){

      if (this.form.phone === ''){
        Notification.error("Phone number required!")
        return true
      }else if (this.form.email === ''){
        Notification.error("Email number required!")
        return true
      } else if (this.form.vat === ''){
        Notification.error("Vat number required!")
        return true
      }

      return false


    }

  }
}
</script>

<style scoped>

</style>