<template>
  <div class="listCustomer">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'order_list'}">Order List</router-link></li>
              <li class="breadcrumb-item active">Order Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="text-center">Order Info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped table-hover">
                  <tr>
                    <td>Order Date:</td>
                    <td>{{  getOrder.order_date }}</td>
                  </tr>
                  <tr>
                    <td>Advance pay:</td>
                    <td>{{  getOrder.advance_pay }}</td>
                  </tr>
                  <tr>
                    <td>Due pay:</td>
                    <td>{{  getOrder.due_pay }}</td>
                  </tr>
                  <tr>
                    <td>Total Qty:</td>
                    <td>{{  getOrder.total_qty }}</td>
                  </tr>
                  <tr>
                    <td>Sub Total:</td>
                    <td>{{  getOrder.subtotal }} Tk</td>
                  </tr>
                  <tr>
                    <td>Vat:</td>
                    <td>{{  getOrder.vat }} Tk</td>
                  </tr>
                  <tr>
                    <td>Total:</td>
                    <td>{{  getOrder.total }} Tk</td>
                  </tr>


                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="text-center">Customer Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped table-hover">
                  <tr>
                    <td>Customer Name:</td>
                    <td>{{ customer.name }}</td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>{{  customer.email }} Tk</td>
                  </tr>
                  <tr>
                    <td>Phone:</td>
                    <td>{{  customer.phone }} Tk</td>
                  </tr>
                  <tr>
                    <td>Address:</td>
                    <td>{{  customer.address }} Tk</td>
                  </tr>

                </table>
              </div>
            </div>
          </div>
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
                <h3 class="text-center">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Product Price</th>
                    <th>Sub Total</th>
                    <th>Photo</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(product, index) in orderDetail" :key="product.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.qty }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.sub_price }}</td>
                    <td><img :src="imagePath(product.photo)" width="60px" alt=""></td>
                  </tr>
                  </tbody>
                </table>
                <!--                <h3 class="text-center" v-else>No data found!</h3>-->
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
export default {
  name: "OrderDetail",
  created() {
    this.getOrderDetail()
  },
  data(){
    return {
      getOrder:'',
      customer: '',
      orderDetail: []
    }
  },
  methods: {
    getOrderDetail(){
      let id = this.$route.params.id;
      axios.get('/orderdetail/'+id).then(res => {
        this.getOrder = res.data;
        this.customer = res.data.customer;
        this.orderDetail = res.data.order_detail
      })
    },
    imagePath(path){
      return '/'+path;
    }
  }
}
</script>

<style scoped>

</style>