<template>
  <div class="listCustomer">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
              <li class="breadcrumb-item active">Order List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="text-center">Search Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <input @change="searchOrder" type="date" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-10 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="text-center">Order List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-if="orderList.length > 0">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Advance</th>
                    <th>Due</th>
                    <th>Pay By</th>
                    <th>Total Qty</th>
                    <th>Sub Total</th>
                    <th>Vat</th>
                    <th>Total</th>
                    <td>Action</td>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(order, index) in orderList" :key="order.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ order.order_date }}</td>
                    <td>{{ order.customer.name }}</td>
                    <td>{{ order.advance_pay }}</td>
                    <td>{{ order.due_pay }}</td>
                    <td>{{ order.pay_by }}</td>
                    <td>{{ order.total_qty }}</td>
                    <td>{{ order.subtotal }} Tk</td>
                    <td>{{ order.vat }} Tk</td>
                    <td>{{ order.total }} Tk</td>
                    <td><router-link class="btn btn-info" :to="{name:'order_detail', params:{id:order.id}}"><i class="fa fa-eye"></i></router-link></td>
                  </tr>
                  </tbody>
                </table>
                                <h3 class="text-center" v-else>No data found!</h3>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "OrderList",
  created() {
    this.getOrderList();
    // this.searchOrder();
  },
  data(){
    return {
      orderList:[],
      search_date:''
    }
  },
  methods: {
    getOrderList(){
      axios.get('/order').then(res => {
        this.orderList = res.data
      })
    },
    searchOrder(e){
      this.search_date = e.target.value;
      let data = {
        search_date: this.search_date
      }
      console.log(this.search_date)
      axios.post('/ordersearch', data).then(res => {
        this.orderList = res.data
      })
    }
  }
}
</script>

<style scoped>

</style>