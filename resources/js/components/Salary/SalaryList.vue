<template>
  <div class="listSalary">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salary List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_salary'}">Salary</router-link></li>
              <li class="breadcrumb-item active">Salary List</li>
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
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'add_salary'}">Add Salary</router-link>
                </h3>
                <br><br>
                <div class="row">
                  <div class="col-md-4 mx-auto">
                    <!--                      <form @submit.prevent="SearchEmployee">-->
                    <div class="input-group">
                      <input type="text" class="form-control" v-model="search_keyword" placeholder="Search Salary">
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
                <table class="table table-bordered" v-if="salaries.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Employee Name</th>
                    <th>Salary Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(salary, index) in SearchExpense" :key="expense.id">
                    <td>{{ index+1 }}</td>
                    <td>{{salary.employee.name }}</td>
                    <td>{{salary.date }}</td>
                    <td>{{salary.amount }}</td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'edit_salary', params:{id:salary.id}}"><i class="fa fa-edit"></i></router-link>
                      || <button @click.prevent="deleteAction(salary.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <h3 class="text-center" v-else>No data found!</h3>
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
  name: "SalaryList",
  created() {
    this.authentication();
    this.getSalary()
  },
  computed:{
    SearchExpense(){
      return this.salaries = this.salaries.filter(salary => {
        if (salary.employee.name.match(this.search_keyword)){
          return salary.employee.name.match(this.search_keyword)
        }
        axios.get('/salary').then(response => {
          this.salaries = response.data;
        })
      })
    }
  },
  data(){
    return {
      salaries: [],
      search_keyword: ''
    }
  },
  methods:{
    authentication(){
      if (!User.authenticate()){
        return this.$router.push({
          name: 'login'
        });
      }
    },
    getSalary(){
      axios.get('/salary').then(response => {
        this.salaries = response.data;
      }).catch(error => {

      })
    },
    deleteAction(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/salary/'+id).then(response => {
            this.salaries = this.salaries.filter(salary => {
              return salary.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              'Salary has been deleted.',
              'success'
          )
        }
      })
    },
    imagePath(value){
      return value ?  '/'+value : null
    },
  }
}
</script>