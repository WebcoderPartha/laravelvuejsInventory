<template>
  <div class="addCategory">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{name: 'list_category'}">Category</router-link></li>
              <li class="breadcrumb-item active">Add Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 mx-auto">
            <!-- general form elements -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="storeData" >

                <div class="card-body">

                  <div class="closestItem">

                    <div class="row">
                      <div class="col-md-10">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="name">Name</label>
                          </div>
                          <input type="text" class="form-control" autocomplete="off"  v-model="form.name" id="name" placeholder="Category">
                        </div>
                        <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>
                      </div>
                      <div class="col-md-2">
<!--                        <div class="btn btn-sm btn-info" id="addmore">+</div>-->
                      </div>
                    </div><!--  /end Row -->

                  </div> <!--  /end closestItem -->

                  <div class="input-group mb-3">
                    <input type="submit" class="btn btn-success btn-sm" value="Add Category">
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
<!--    <div class="addItem" style="display: none">-->
<!--      <div class="removeItem">-->
<!--        <div class="row">-->
<!--          <div class="col-md-10">-->
<!--            <div class="input-group mb-3">-->
<!--              <div class="input-group-prepend">-->
<!--                <label class="input-group-text" for="name">Name</label>-->
<!--              </div>-->
<!--              <input type="text" class="form-control" autocomplete="off" v-model="form.name" id="name" placeholder="Category ">-->
<!--            </div>-->
<!--            <small class="text-red" v-if="errors.name">{{ errors.name[0] }}</small>-->
<!--          </div>-->
<!--          <div class="col-md-2">-->
<!--            <button class="btn btn-sm btn-info" @click.prevent="addMore" id="addmore">+</button>-->
<!--            <button class="btn btn-sm btn-danger" @click.prevent="removeItem" id="remove">-</button>-->
<!--          </div>-->
<!--        </div>&lt;!&ndash;  /end Row &ndash;&gt;-->
<!--      </div>-->
<!--    </div>-->
  </div>
</template>

<script>
// $(document).ready(function (){
//   $(document).on('click', '#addmore', function (){
//     let addItem = $('.addItem').html();
//     $(this).closest('.closestItem').append(addItem);
//   });
//
//   $(document).on('click', '#remove', function (){
//     $(this).closest('.removeItem').remove();
//   });
// });
export default {
  name: "addCategory",
  data(){
    return {

      form: {
        name: null
      },
      errors: {}
    }
  },
  created() {
    this.authentication();
  },
  methods: {
    authentication(){
      if (!User.authenticate()){
        return this.$router.push({
          name: 'login'
        });
      }
    },

    storeData(){

      axios.post('/category', this.form)
          .then(response => {
            this.$router.push({name:'list_category'})
            Notification.success(response.data)
          }).catch(error => {
        this.errors = error.response.data.errors
      })
    },


  }
}
</script>

<style scoped>

</style>