<template>
  <div class="listExpense">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expense List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_expense'}">Expense</router-link></li>
              <li class="breadcrumb-item active">Expense List</li>
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
                <h3 class="card-title"><router-link class="btn btn-sm btn-info" :to="{name:'add_expense'}">Add Expense</router-link>
                </h3>
                <br><br>
                <div class="row">
                  <div class="col-md-4 mx-auto">
                    <!--                      <form @submit.prevent="SearchEmployee">-->
                    <div class="input-group">
                      <input type="text" class="form-control" v-model="search_keyword" placeholder="Search category">
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
                <table class="table table-bordered" v-if="expenses.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Details</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(expense, index) in SearchExpense" :key="expense.id">
                    <td>{{ index+1 }}</td>
                    <td>{{expense.details }}</td>
                    <td>{{expense.amountt }}</td>
                    <td>{{expense.date }}</td>
                    <td>
                      <router-link class="btn btn-sm btn-primary" :to="{name:'edit_expense', params:{id:expense.id}}"><i class="fa fa-edit"></i></router-link>
                      || <button @click.prevent="deleteAction(expense.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
  name: "ExpenseList",
  created() {
    this.authentication();
    this.getExpense()
  },
  computed:{
    SearchExpense(){
      return this.expenses = this.expenses.filter(expense => {
        if (expense.details.match(this.search_keyword)){
          return expense.details.match(this.search_keyword)
        }
        axios.get('/expense').then(response => {
          this.expenses = response.data;
        })
      })
    }
  },
  data(){
    return {
      expenses: [],
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
    getExpense(){
      axios.get('/expense').then(response => {
        this.expenses = response.data;
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
          axios.delete('/expense/'+id).then(response => {
            this.expenses = this.expenses.filter(expense => {
              return expense.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              'Expense has been deleted.',
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