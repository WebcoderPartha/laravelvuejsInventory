<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4" id="lefmenubar" style="display: none" v-show="!(this.$route.path === '/' || this.$route.path === '/register')">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
<!--      <div class="form-inline">-->
<!--        <div class="input-group" data-widget="sidebar-search">-->
<!--          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">-->
<!--          <div class="input-group-append">-->
<!--            <button class="btn btn-sidebar">-->
<!--              <i class="fas fa-search fa-fw"></i>-->
<!--            </button>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link :to="{name:'dashboard'}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name:'setting'}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings

              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name:'pos'}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                POS

              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Employee
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_employee'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_employee'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee List</p>
                </router-link>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Supplier
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_supplier'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Supplier</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_supplier'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier List</p>
                </router-link>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_category'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_category'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </router-link>
              </li>

            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_product'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_product'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link :to="{name:'stock_products'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock</p>
                </router-link>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Expense
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_expense'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expense</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_expense'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense List</p>
                </router-link>
              </li>

            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Salary
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_salary'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Salary</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_salary'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salary List</p>
                </router-link>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Customer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'add_customer'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Customer</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'list_customer'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer List</p>
                </router-link>
              </li>

            </ul>
          </li>



          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'today_order'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today Order</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name:'order_list'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order List</p>
                </router-link>
              </li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
$(document).ready(function (){
  let token = localStorage.getItem('token');
  if (token){
    $('#lefmenubar').css('display', '')
  }
})
export default {
  name: "MenuBar"
}
</script>

<style scoped>

</style>