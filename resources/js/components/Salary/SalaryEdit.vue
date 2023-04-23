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
              <li class="breadcrumb-item active">Update Salary</li>
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
                <h3 class="card-title">Update Salary</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="updateData">

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-5">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="employee_id">Employee</label>
                        </div>
                        <select class="form-control" v-model="form.employee_id" id="employee_id">
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
                        <input type="text" class="form-control" v-model="form.amount" id="amount" placeholder="Amount">
                      </div>
                    </div><!-- /end Col -->

                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="salary_date">Date</label>
                        </div>
                        <input type="date" class="form-control" v-model="form.salary_date" id="salary_date">
                      </div>
                    </div><!-- /end Col -->


                  </div> <!-- /end Row -->


                  <div class="input-group mb-1">
                    <input type="submit" class="btn btn-success btn-sm" value="Update Salary">
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
  name: "SalaryEdit",
  created() {
    this.getEmployee();
    this.getSalary();
  },
  data(){
    return {
      form: {
        employee_id: '',
        salary_date: '',
        amount: ''
      },
      employees: []
    }
  },
  methods:{
    updateData(){
      // console.log(this.form.salaries)
      if (!this.validation()){
        axios.put('/salary/'+this.$route.params.id, this.form).then(res => {
          this.$router.push({name: 'list_salary'})
          Notification.success(res.data)
        }).catch(error => {
          // error.response.data.errors
          if (error.response.data.errors !== ''){
            Notification.error("Field must not be empty!")
          }
        })
      }
    },
    getEmployee(){
      axios.get('/employee').then(res=> this.employees = res.data)
    },
    getSalary(){
      axios.get('/salary/'+this.$route.params.id).then(res=> this.form = res.data)
    },
    validation(){
      if (this.form.employee_id.length === 0 || this.form.amount.length ===0 || this.form.employee_id.salary_date === 0){
        Notification.error('Field must not be empty!')
        return true
      }
    }
  }
}
</script>

<style scoped>

</style>