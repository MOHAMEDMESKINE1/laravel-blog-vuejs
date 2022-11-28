<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-light shadow-sm ">
    <div class="container-fluid">
        <router-link class="navbar-brand" :to="{name:'home'}"><i><b>MyBlog</b></i> </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link " :to="{name:'home'}">Acceuil</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link " :to="{name:'categories'}">Categories</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name:'register'}" v-if="!logged">Register</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name:'login'}" v-if="!logged">
                      
                        Login
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name:'admin'}">
                      
                        Admin Panel
                    </router-link>
                </li>
                <li class="nav-item me-auto">
                    <div class="" >
                        <a class="nav-link" style=" cursor : pointer;" @click="logout" v-if="logged" >
                        
                        <span class="text-success mx-1"><i><b> {{name.toUpperCase()}}    </b></i></span>
                         Log Out
                     </a >
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
  </div>
</template>

<script>
export default {
    data(){
        return {
            // get if user logged
            logged : User.isLogged().logged,
            name:User.isLogged().name
        }
    },
    methods : {
        logout(){

            User.logout();
            this.logged = false;
            this.$router.go()
        }
    }
}
</script>

<style>

</style>