<template>
    <div class="container">
        <div class="row my-4">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">Articles</div>

                    <div class="card-body"
                        v-for="(post,index) in posts"
                        :key="index"
                    >
                        <div class="media">
                            <img :src="post.photo" class="rounded shadow-sm img-fluid mr-2" alt="" >
                           
                            <div class="media-body">
                                <router-link :to="post.path">
                                    <h3>{{post.title}}</h3>
                                </router-link>
                                <p>
                                    <span class="text-default">
                                        {{ post.user ? post.user.name : '-' }}
                                    </span>
                                    <span class="text-danger">
                                        {{post.added}}
                                    </span>
                                </p>
                                <p class="lead">{{post.body.substr(0,200)}}...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
              <div class="mt-5">
                <categories></categories>
              </div>
            </div>
        </div>
  </div>
</template>
<!--  "laravel-vue-pagination": "^3.0.0", -->
<script>
import axios from 'axios'
export default {
   
    props: ['slug'],

    data(){
        return {
                posts : {}
        }
    },
   mounted(){
    this.getPosts();
   },
    methods : {
        getPosts(){
            // this.$route.params.slug
                axios.get('/api/posts/category/'+this.slug)
                .then(response => {
                    this.posts = response.data
                    console.log(response.data);
                })
                .catch(err=> console.log(err))
        }
        
    },
    watch : {
        '$route':'getPosts'
    }
}
</script>

<style>

</style>