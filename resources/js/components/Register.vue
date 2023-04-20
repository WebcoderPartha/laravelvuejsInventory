<template>
  <div class="register-page">
    <div class="register-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <h3><b>Inventory Admin</b></h3>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Register a new membership</p>

          <form @submit.prevent="register">
            <div class="input-group mb-3">
              <input type="text" class="form-control" v-model="form.name" placeholder="Name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" v-model="form.email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" v-model="form.password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">

              <!-- /.col -->
              <div class="col-4 mx-auto">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <br>
          <div class="text-center">
            <router-link :to="{name:'login'}" class="text-center">I already have a membership</router-link>
          </div>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Register",
  data(){
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      }
    }
  },
  created() {
    this.authentication()
  },
  methods: {
    authentication(){
      if (User.authenticate()){
        this.$router.push({name: 'dashboard'})
        Notification.error('Unauthorized!')
      }
    },
    register(){
      axios.post('/auth/register', this.form)
          .then(response => {

            User.responseAfterLogin(response.data.access_token, response.data.userId)
            // this.$router.push({name: 'dashboard'})
            Notification.success('Register successfully!')
            window.location.href = '/dashboard'

          }).catch(error =>{
            console.log(error.response)
      })
    }
  }
}
</script>

<style scoped>

</style>