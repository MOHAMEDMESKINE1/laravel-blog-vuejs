<template>
 <div class="container">
        <div class="row my-4">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card text-start">
                  <div class="card-header p-4 text-center"><h2>{{post.title}}</h2></div>
                  <img class="img-fluid"  style="height:180px;  object-fit: cover;"  :src="post.photo" alt="photo">
                
                  <div class="card-body">
                    
                   
                    <p class="card-text">
                      {{post.body.substring(0,300)}}
                    </p>
                      <small class="text-secondary mt-1 text-start">Posté : {{post.created_at}}</small><br>
                      <small class="text-secondary mt-1">User   : {{post.user}}</small>
                  </div>

                </div>
            </div>     
        </div>
        <div class="row bg-light shadow   ">
          <div class="col-md-12 mx-auto">
            <h3 class="my-3 text-dark">Ajouter un commentaire</h3>
                <div class="form-group mb-3">
                  <label for="">Commentaire</label>
                  <textarea
                    class="form-control"
                    col="30" rows="3"
                    v-model="comment"
                    ></textarea>
                </div>
                <button class="btn btn-primary" @click.prevent="addComment(post.id)">Ajouter un commentaire</button>
                <!-- <button class="btn btn-primary" @click.prevent="deleteComment(post.id)">Supprimer un commentaire</button> -->
              <h3 class="my-3 text-dark">
                Commentaires : <span class="badge bg-success">
                {{post.comments_count }}
              </span>
            </h3>
            
                <div class="bg-light shadow p-2 mb-3 " v-for="comment in post.comments" :key="comment.id">
                    <h3 class="text-success ">{{comment.user}}</h3>
                    <small class="text-secondary">{{comment.created_at}}</small>
                    <p>{{comment.body.substr(1,200)}}</p>
                </div>
              
          </div>
        </div>
</div>

</template>

<script>
import axios from 'axios'
export default {
  props: ['id'],
  data(){
    return  {
        post :'',
        comment:'',
        
    }
  },
  created(){
    
    this.getPosts();
  },
  methods : {
    getPosts(){
      // let id = this.$route.params.id;
      axios.get("/api/posts/" +this.id)
      .then(response => {
          this.post =response.data
          console.log(response.data)

      }).catch(error=>{
        console.log(error)
      })
    },
    addComment(id){
      axios.post('/api/comments',{
        post_id:id,
        body :this.comment
      })
      .then(res=> console.log(res.data))
      this.getPosts();
      this.comment = "";

    },
    // deleteComment(id){
    //   axios.delete('/api/posts'+id)

    //   this.getPosts();
    // }
  }
}
</script>

<style>

</style>