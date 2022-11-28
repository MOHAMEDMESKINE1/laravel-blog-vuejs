<template>
<div>
    
    <div class="container mt-5">
       <div class="row">
        <!-- categories -->
            <div class="col-md-4">
                <div class="mb-3">
                    <categories></categories>
                </div>
           </div>
        <!-- categories -->

           <div class="col-md-8 ">
              <div class="card ">
                <div class="card-header"><h2>Articles</h2></div>
                <div class="card-body">
                    <div class="d-flex mb-3 bg-light text-dark rounded rounded-2 shadow-sm" v-for="(post,index) in posts.data" :key="index">

                        <div class="flex-shrink-0">
                            <img :src="post.photo" class="img-fluid rounded rounded-1" alt="image">
                        </div>
                        <div class="flex-grow-1 ms-3 my-3">
                            <h5 class="mb-3"> 
                            <router-link :to="{name:'PostDetails',params:{id :post.id}}">
                                <h3>{{post.title}}</h3>
                            </router-link>
                            <!-- <router-link :to="post.id">
                                <h3>{{post.title}}</h3>
                            </router-link> -->
                                
                            </h5>
                            <h5 class="text-success">
                                    <!-- Posted By : <i>{{post.user.name}}</i> -->
                                    <small class="text-muted">
                                    <i class="fw-bold text-dark">{{post.added}}</i>
                                </small>
                            </h5>
                            <p>{{post.body.substr(0,10)}}</p>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <!-- <div class="card-footer d-flex justify-content-center align-items-center ">
                    <pagination :data="posts" @pagination-change-page="getPosts"></pagination>
                </div> -->
              </div>
           </div>
          
         
       </div>
       
   </div>
   
</div>
</template>

<script>
import axios from 'axios';

    export default {
       
        data(){
            return {
                posts : {}
            }
        },
       
        mounted(){
            this.getPosts();
        },
        methods : {
            // getPosts(page){
            //     if(typeof page === "undefined"){
            //         page = 1
            //     }
            //     axios.get("/api/posts?page="+page)
            //     .then(response=>{
            //         this.posts =response.data
            //         console.log(response.data);
            //     })
            //     .catch(err=>console.log(err))
            // }
            getPosts(){
                axios.get("/api/posts")
                .then(response=>{
                    this.posts =response.data
                    console.log(response.data);
                })
                .catch(err=>console.log(err))
            }
        }
    }
    
</script>
