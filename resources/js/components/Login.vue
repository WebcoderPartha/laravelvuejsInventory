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
            <div class="input-group mb-3">
              <input type="password"  v-model="form.password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>



          <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
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
      }
    }
  },
  created() {
    this.authenticate()
  },
  methods: {
    Login(){
      axios.post('/api/auth/login', this.form)
          .then(res => {
            console.log(res.data.userId);
            User.responseAfterLogin(res.data.access_token, res.data.userId)
          }).catch(error => {
            console.log(error.response.data)
      })
    },
    authenticate(){
      if (User.authenticate()){
        return this.$router.push({name:'register'})
      }
    }
  }
}
</script>

<style scoped>

</style>