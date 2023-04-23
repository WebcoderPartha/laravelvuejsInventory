<template>
  <div class="addExpense">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expense</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_expense'}">Expense</router-link></li>
              <li class="breadcrumb-item active">Add Expense</li>
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
                <h3 class="card-title">Add Expense</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="storeData">

                <div class="card-body">

                  <div class="row" v-for="(expense, index) in form.expenses">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="details">Details</label>
                        </div>
                        <input type="text" class="form-control" v-model="expense.details" id="details" placeholder="Details">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="amount">Amount</label>
                        </div>
                        <input type="text" class="form-control" v-model="expense.amount" id="amount" placeholder="Amount">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="date">Date</label>
                        </div>
                        <input type="date" class="form-control" v-model="expense.date" id="date">
                      </div>
                    </div>
                    <div class="col-md-2 mt-1">
                      <div class="btn btn-info btn-sm" @click="addItem">+</div>&nbsp;
                      <div class="btn btn-danger btn-sm" v-if="index !== 0" @click="removeItem(index)">-</div>
                    </div>
                  </div>
<!--                  <small class="text-red" v-if="errors.product_name">{{ errors.product_name[0] }}</small>-->

                 <div class="row">
                   <div class="col-md-4 mx-auto">
                     <div class="input-group mb-3">
                       <input type="submit" class="btn btn-success" value="Add Expense">
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
  name: "ExpenseCreate",
  data(){
    return {
      form:{
        expenses:[
            {details: '', amount: '', date: ''}
        ]
      }
    }
  },
  methods: {
    storeData(){
      if (!this.validation()){
        axios.post('/expense', this.form).then(response => {
          this.$router.push({name:'list_expense'})
          Notification.success(response.data)
        }).catch(error => {

        })
      }
    },
    addItem(){
      if (!this.validation()){
        this.form.expenses.push({details: '', amount: '', date: ''})
      }
    },
    removeItem(index){
      this.form.expenses.splice(index, 1)
      if (index === 0){
        this.form.expenses
      }
    },
    validation(){
      for(let i = 0; i < this.form.expenses.length; i++){
        if (this.form.expenses[i]['details'].length === 0 || this.form.expenses[i]['amount'].length === 0 || this.form.expenses[i]['date'].length === 0){
          Notification.error('Field must not be empty!')
          return true
        }
      }
    }
  }
}
</script>

<style scoped>

</style>