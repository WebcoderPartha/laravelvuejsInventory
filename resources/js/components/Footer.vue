<template>
  <footer class="main-footer" id="footer" style="display: none" v-show="!(this.$route.path === '/' || this.$route.path === 'register')">
    <strong>Copyright &copy; 2023 Partha</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">

    </div>
  </footer>
</template>

<script>
$(document).ready(function (){
  let token = localStorage.getItem('token');
  if (token){
    $('#footer').css('display', '')
  }
})
export default {
  name: "Footer"
}
</script>

<style scoped>

</style>