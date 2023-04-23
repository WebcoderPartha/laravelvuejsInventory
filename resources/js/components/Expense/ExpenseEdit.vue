<template>
  <div class="editExpense">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expense</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_expense'}">Expense</router-link></li>
              <li class="breadcrumb-item active">Edit Expense</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 mx-auto">
            <!-- general form elements -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Expense</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="updateData">

                <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="details">Details</label>
                        </div>
                        <input type="text" class="form-control" v-model="form.details" id="details" placeholder="Details">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="amount">Amount</label>
                        </div>
                        <input type="text" class="form-control" v-model="form.amount" id="amount" placeholder="Amount">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="date">Date</label>
                        </div>
                        <input type="date" class="form-control" v-model="form.date" id="date">
                      </div>
                    </div>
                  </div>
                  <!--                  <small class="text-red" v-if="errors.product_name">{{ errors.product_name[0] }}</small>-->

                  <div class="row">
                    <div class="col-md-4 mx-auto">
                      <div class="input-group mb-3">
                        <input type="submit" class="btn btn-success" value="Update Expense">
                      </div>
                    </div>
                  </div>

                </div>     <!-- /.card-body -->

              </form>
            </div>
            <!-- /.card -->
            <!-- Horizontal Form -->

            <!-- /.card -->

          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ExpenseEdit",
  created() {
    this.getExpense()
  },
  data(){
    return {
      form: {
        details: '',
        amount: '',
        date: ''
      }
    }
  },
  methods: {
    updateData(){
      if (!this.validate()){
        axios.put('/expense/'+this.$route.params.id, this.form).then(response=> {
          this.$router.push({name: 'list_expense'})
          Notification.success(response.data)
        }).catch(error => {

        })
      }
    },
    getExpense(){
      axios.get('/expense/'+this.$route.params.id).then(response=>{
        this.form = response.data
      })
    },
    validate(){
      if (this.form.details.length === 0 || this.form.amount.length === 0 || this.form.date.length === 0){
        Notification.error("Field must not be empty!")
        return true
      }
    }
  },


}
</script>

<style scoped>

</style>