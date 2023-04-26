<template>
  <div class="row">
    <!-- left column -->
    <div class="col-md-10 mx-auto">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">POS</h3>
          <div class="buttonCOn float-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#customer">
              Add Customer
            </button>
          </div>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered" v-if="getCartData.length > 0">
            <thead>
            <tr>
              <th>SL</th>
              <th>Name</th>
              <th>Qty</th>
              <th>Unit</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(cart, index) in getCartData" :key="cart.id">
              <td>{{ index+1 }}</td>
              <td>{{ cart.product_name  }}</td>
              <td>{{ cart.quantity  }}</td>
              <td>{{ cart.product_price  }}</td>
              <td>{{ cart.sub_total  }}</td>

              <td><span @click.prevent="removeCart(cart.id)" class="btn btn-sm btn-danger">X</span></td>
            </tr>
            </tbody>
          </table>
          <h3 v-else>No cart</h3>
        </div><!-- /.card-body -->

      </div> <!-- /.card -->
    </div> <!-- /col-md-5 -->
    <!--  /end left column -->



  </div> <!-- /.row -->
</template>

<script>
export default {
  name: "Cart",
  data(){
    return {

    }
  },
  props: ['getCartData'],
  created() {

  },
  methods: {
    removeCart(cartID){
      this.$emit('deleteCart', {cartID})

    }
  }
}
</script>

<style scoped>

</style>