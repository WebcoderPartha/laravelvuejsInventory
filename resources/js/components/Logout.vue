<template>
  <div>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Logout",
  created() {
    axios.get('/auth/logout').then(res=> {
      localStorage.removeItem('token')
      localStorage.removeItem('userid');
      Notification.success(res.data)
      this.$router.push({name:'login'})
    })
  }

}
</script>

<style scoped>

</style>