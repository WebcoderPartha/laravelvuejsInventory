<template>
  <div id="dashboard">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name:'dashboard'}">Home</router-link></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Order</span>
                <span class="info-box-number">
                  {{ todayOrderCount }}
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Order Price</span>
                <span class="info-box-number">{{ todayTotalPrice }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number">{{ customerCount }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Employees</span>
                <span class="info-box-number">{{ employeeCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  data(){
    return {
      todayOrderCount: '',
      todayTotalPrice: '',
      customerCount: '',
      employeeCount: '',
      supplierCount: '',
      productCount: '',
    }
  },
  created() {
    this.authentication();
    this.todayOrder();
    this.getCustomerCount();
    this.getEmployeeCount();
    this.getSupplierCount();
    this.getProductCount();
  },
  methods: {
    authentication(){
      if (!User.authenticate()){
        return this.$router.push({
          name: 'login'
        });
      }
    },
    todayOrder(){
      axios.get('/todyorder').then(res => {
        this.todayOrderCount = res.data.todayOrders;
        this.todayTotalPrice = res.data.todayTotalPrice;
      })
    },
    getCustomerCount(){
      axios.get('/cuscount').then(res => {
        this.customerCount = res.data;
      })
    },
    getEmployeeCount(){
      axios.get('/empcount').then(res => {
        this.employeeCount = res.data;
      })
    },
    getSupplierCount(){
      axios.get('/supcount').then(res => {
        this.supplierCount = res.data;
      })
    },
    getProductCount(){
      axios.get('/procount').then(res => {
        this.productCount = res.data
      })
    },
  }
}
</script>

<style scoped>

</style>