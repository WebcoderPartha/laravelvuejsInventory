<template>
  <div class="addEmployee">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_employee'}">Employee</router-link></li>
              <li class="breadcrumb-item active">Employee List</li>
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
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'add_employee'}">Add Employee</router-link>
                </h3>
                <br><br>
                <div class="row">
                    <div class="col-md-4 mx-auto">
<!--                      <form @submit.prevent="SearchEmployee">-->
                      <div class="input-group">
                        <input type="text" class="form-control" v-model="search_keyword" placeholder="Search employee">
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
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>NID</th>
                    <th>Salary</th>
                    <th>Join Date</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(employee, index) in SearchEmployee" :key="employee.id">
                    <td>{{ index+1 }}</td>
                    <td>{{employee.name }}</td>
                    <td>{{employee.email }}</td>
                    <td>{{employee.phone }}</td>
                    <td>{{employee.address }}</td>
                    <td>{{employee.nid }}</td>
                    <td>{{employee.salary }}</td>
                    <td>{{employee.joining_date }}</td>
                    <td><img :src="imagePath(employee.photo)" width="40" alt=""></td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'edit_employee', params:{id:employee.id}}"><i class="fa fa-edit"></i></router-link>
                      || <button @click.prevent="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                  </tbody>
                </table>
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
  name: "EmployeeList",
  created() {
    this.authentication();
    this.getEmployee()
  },
  computed:{
    SearchEmployee(){
      return this.employees = this.employees.filter(employee => {
        if (employee.name.match(this.search_keyword)){
          return employee.name.match(this.search_keyword)
        }else if(employee.phone.match(this.search_keyword)){
          return employee.phone.match(this.search_keyword)
        }else if(employee.email.match(this.search_keyword)){
          return employee.email.match(this.search_keyword)
        }
        axios.get('/employee').then(response => {
          this.employees = response.data;
        })
      })
    }
  },
  data(){
    return {
      employees: [],
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
    getEmployee(){
      axios.get('/employee').then(response => {
        this.employees = response.data;
      }).catch(error => {

      })
    },
    deleteEmployee(id){
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
          axios.delete('/employee/'+id).then(response => {
            this.employees = this.employees.filter(employee => {
              return employee.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              'Employee has been deleted.',
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

<style scoped>

</style>