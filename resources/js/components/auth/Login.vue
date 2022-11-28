<template>
   <div>
    <div class="container m-5">
      <div class="row">
        <div class="col-md-8 mx-auto  d-flex flex-column  justify-content-center  ">
          <div class="card border-secondary mx-5">
              <div class="card-header"><h2 class="text-uppercase text-center p-2">Login</h2></div>
            <div class="card-body">
                  <!-- email -->
                  <div class="form-floating mb-3">
                    <input
                    type="email"
                    class="form-control" name="email" v-model="email" id="email" placeholder="example@gmail.com">
                    <label for="email">Email</label>
                    <div v-if="email.length<=0">
                        <small class="text-danger">
                          This field is required 
                        </small>
                    </div>
                  </div>
                  <!-- password -->
                  <div class="form-floating mb-3">
                    <input
                    type="password"
                    class="form-control" name="password" v-model="password" id="password" placeholder="****">
                    <label for="password">Password</label>
                    <div v-if="password.length<=0">
                        <small class="text-danger">
                          This field is required 
                        </small>
                    </div>
                  </div>
                  <button class="btn btn-primary" @click.prevent="login">Log In  </button>
            </div>
          </div>
      </div>

      </div>    
  </div>

  </div>

</template>

<script>
export default {
  data(){
    return {
      email:'',
      password :''
      
    }
  },
  created(){
      if(User.isLogged()){

        this.$router.push({name:'home'})
        
      }
  },
  methods : {
    login(){
        axios.post('/api/users/login',{
          email:this.email,
          password:this.password,
        }).then(response => {
              User.storeUser(JSON.stringify(response.data))
              this.$router.go()
              console.log(response.data)

        }).catch(err => console.log(err))
    }
  }
}
</script>

<style>

</style>