<template>
  <div class="wrapper">

        <!-- Preloader -->
<!--    <div class="preloader flex-column justify-content-center align-items-center">&#45;&#45;}}-->
<!--      <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">&#45;&#45;}}-->
<!--    </div>-->

    <!-- Navbar -->
      <TopHeader />
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <MenuBar />

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="contentWrapper" style="margin-left: 0">
      <router-view></router-view>
    </div>
    <!-- /.content-wrapper -->


    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <Footer />

  </div>
</template>

<script>
$(document).ready(function (){
  let token = localStorage.getItem('token');
  if (token){
    $('#contentWrapper').css('margin-left', '')
  }
})
import TopHeader from "./components/TopHeader.vue";
import MenuBar from "./components/MenuBar.vue";
import Footer from "./components/Footer.vue";
export default {

  name: "Main",
  components: {
    MenuBar,
    TopHeader,
    Footer
  }
}
</script>

<style scoped>

</style>