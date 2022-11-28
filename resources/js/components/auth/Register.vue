<template>
  <div>
    <div class="container m-5">
      <div class="row">
        <div class="col-md-8 mx-auto ">
          <div class="card border-secondary mx-5">
              <div class="card-header"><h2 class="text-uppercase text-center p-2">Register</h2></div>
            <div class="card-body">
               <form @submit.prevent="register">

                   <!-- name -->
                   <div class="form-floating mb-3">
                    <input
                    type="text"
                    class="form-control" 
                     v-model="name" id="name" placeholder="name">
                    <label for="name">Name</label>
                    <!-- <div v-if="name.length<=0">
                        <small class="text-danger">
                          <b> This field is required </b>
                        </small>
                    </div> -->
                  </div>
                  <!-- email -->
                  <div class="form-floating mb-3">
                    <input
                    type="email"
                    required
                    class="form-control" 
                    v-model="email" id="email" placeholder="example@gmail.com">
                    <label for="email">Email</label>
                    <div v-if="email.length<=0">
                        <small class="text-danger">
                          <b>This field is required </b>
                        </small>
                    </div>
                  </div>
                  <!-- password -->
                  <div class="form-floating mb-3">
                    <input
                    type="password"
                    class="form-control" 
                    v-model="password" id="password" placeholder="****">
                    <label for="password">Password</label>
                    <div v-if=" password.length<6">
                        <small class="text-warning">
                          <b>Password cannot be less than 6 chars</b>
                        </small>
                    </div>
                    <div v-if="password.length<=0">
                        <small class="text-danger">
                          <b>  This field is required </b>
                        </small>
                    </div>
                  </div>
                  <!--confirm password -->
                  <div class="form-floating mb-3">
                    <input
                    type="password"
                    class="form-control" v-model="passwordConfirm" id="passwordConfirm" placeholder="****">
                    <label for="passwordConfirm">passwordConfirm</label>
                    
                    <div v-if="password !== passwordConfirm  ">
                        <small class="text-warning">
                          <b> Password must be matched !</b>
                        </small>
                    </div>
                   
                  
                  </div>
                  <button type="submit" class="btn btn-primary">Register </button>

               </form>
            </div>
          </div>
      </div>

      </div>    
  </div>

  </div>
</template>

<script>
import axios from 'axios'
export default {
    data(){
      return {
      
          name:'',
          email:'',
          password:'',
          passwordConfirm:''
      }
    },
    created(){
        if(User.isLogged()){
          this.$router.push({name:"home"})
        }
    },
    methods: {
      register(){
       
            axios.post('/api/users/register',{
                  name:this.name,
                  email:this.email,
                  password:this.password,
           })
           .then(response => {
           
            
            //  clear fields
             this.name ="";
             this.email ="";
             this.password ="";
             this.passwordConfirm ="";

             User.storeUser(JSON.stringify(response.data))
             this.$router.go()
             console.log(response.data)
          })
           .catch(err => console.log(err))

          
        
      }
    }
}
</script>

<style>

</style>