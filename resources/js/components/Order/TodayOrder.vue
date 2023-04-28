<template>
  <div class="listCustomer">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Today Order List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
              <li class="breadcrumb-item active">Today Order List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'order_list'}">Order List</router-link>
                </h3>
                <br><br>
                <div class="row">
                  <div class="col-md-4 mx-auto">
                    <!--                      <form @submit.prevent="SearchEmployee">-->
                    <div class="input-group">
                      <input type="text" class="form-control"  v-model="search_keyword" placeholder="Search order">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                      </div>
                    </div>
                    <!--                      </form>-->
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-if="todayOrder.length > 0">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Advance</th>
                    <th>Due</th>
                    <th>Pay By</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(order, index) in searchFilter" :key="order.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ order.order_date }}</td>
                    <td>{{ order.customer.name }}</td>
                    <td>{{ order.advance_pay }}</td>
                    <td>{{ order.due_pay }}</td>
                    <td>{{ order.pay_by }}</td>
                    <td>{{ order.total }}</td>
                    <td>
                      <router-link :to="{name:'order_detail', params:{id:order.id}}" class="btn btn-sm btn-primary" ><i class="fa fa-eye"></i></router-link>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <h3 class="text-center" v-else>No today orders found!</h3>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
export default {
  name: "TodayOrder",
  mounted() {
    this.getTodayOrder()
  },
  computed: {
    searchFilter(){
      let keyword = this.search_keyword;
      let firstChar = keyword.charAt(0);
      let value = firstChar.toUpperCase() + keyword.slice(1);
      return this.todayOrder = this.todayOrder.filter(order => {
        if (order.customer.name.match(value)){
          return order.customer.name.match(value);
        }
        this.getTodayOrder();
      })


    }
  },
  data(){
    return {
      todayOrder: [],
      search_keyword: ''
    }
  },
  methods: {
    getTodayOrder(){
      axios.get('/todayorder').then(res => {
        this.todayOrder = res.data;
      })
    },

  }
}
</script>

<style scoped>

</style>