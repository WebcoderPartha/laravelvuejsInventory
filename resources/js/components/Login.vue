<template>
  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Admin Panel</b></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form @submit.prevent="Login">
            <div class="input-group mb-3">
              <input type="email" v-model="form.email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <small class="text-red" v-if="this.errors.email">{{ this.errors.email[0] }}</small>
            <div class="input-group mb-3">
              <input type="password"  v-model="form.password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <small class="text-red" v-if="this.errors.password">{{ this.errors.password[0] }}</small>
            <div class="row">
              <!-- /.col -->
              <div class="col-4 mx-auto">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
          </form>



          <p class="mb-1 text-center">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0 text-center">
            <router-link :to="{name:'register'}" class="text-center">Register a new membership</router-link>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
  </div>
</template>

<script>



export default {
  name: "Login",
  data(){
    return {
      form: {
        email: null,
        password: null
      },
      errors: {}
    }
  },
  created() {
    this.authenticate()
  },
  methods: {
    Login(){
      axios.post('/auth/login', this.form)
          .then(res => {
            User.responseAfterLogin(res.data.access_token, res.data.userId);
            // this.$router.push({name:'dashboard'})
            window.location.href = '/dashboard'
            Notification.success('Login successfully');
          }).catch(error => {
            this.errors = error.response.data.errors
      })
    },
    authenticate(){
      if (User.authenticate()){
        this.$router.push({name:'dashboard'})
      }
    }
  }
}
</script>

<style scoped>

</style>