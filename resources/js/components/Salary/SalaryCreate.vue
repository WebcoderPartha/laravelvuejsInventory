<template>
  <div class="addProduct">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_salary'}">Salary</router-link></li>
              <li class="breadcrumb-item active">Add Salary</li>
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
                <h3 class="card-title">Add Salary</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="storeData">

                <div class="card-body">

                  <div class="row" v-for="(salary, index) in form.salaries">

                    <div class="col-md-5">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="employee_id">Employee</label>
                        </div>
                        <select class="form-control" v-model="salary.employee_id" id="employee_id">
                          <option value="">Select Employee</option>
                          <option v-for="employee in employees" :value="employee.id">{{ employee.name }}</option>
                        </select>
                      </div>
                    </div> <!-- /end Col -->

                    <div class="col-md-3">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="amount">Amount</label>
                        </div>
                        <input type="text" class="form-control" v-model="salary.amount" id="amount" placeholder="Amount">
                      </div>
                    </div><!-- /end Col -->

                    <div class="col-md-3">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="salary_date">Date</label>
                        </div>
                        <input type="date" class="form-control" v-model="salary.salary_date" id="salary_date">
                      </div>
                    </div><!-- /end Col -->

                    <div class="col-md-1">
                      <div class="btn btn-sm btn-primary" @click.prevent="addItem">+</div>&nbsp;
                      <div class="btn btn-sm btn-danger" v-if="index !== 0" @click="removeItem(index)">-</div>
                    </div>

                  </div> <!-- /end Row -->


                  <div class="input-group mb-1">
                    <input type="submit" class="btn btn-success btn-sm" value="Add Salary">
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

export default {
  name: "SalaryCreate",

  created() {
    this.getEmployee();
  },
  data(){
    return {
      form: {
        salaries: [{employee_id: '', salary_date: '', amount: ''}],
      },
      employees: [],

    }
  },
  methods:{
    storeData(){
      // console.log(this.form.salaries)
      axios.post('/salary', this.form).then(res => {
        this.$router.push({name: 'list_salary'})
        Notification.success(res.data)
      }).catch(error => {
        // error.response.data.errors
        if (error.response.data.errors !== ''){
          Notification.error("Field must not be empty!")
        }
      })
    },
    getEmployee(){
      axios.get('/employee').then(res => this.employees = res.data)
    },
    addItem(){
      this.form.salaries.push({employee_id: '', salary_date: '', amount: ''})
    },
    removeItem(index){
      this.form.salaries.splice(index, 1)
      if (index === 0){
        this.form.salaries
      }
    }
  }
}
</script>

<style scoped>

</style>