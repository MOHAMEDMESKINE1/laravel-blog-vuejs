<template>
  <div>
    <div class="container">
        <div class="row my-4">
            <div class="col-md-12">
                <!-- Modal Add Post -->
                 <add-post @added="getPosts()" ></add-post>
                <!-- Modal Add Post -->

                <div class="table-responsive shadow-sm">
                    <table class="table table-primary text-center">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Ajouter Par</th>
                                <th scope="col">Le</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="(post,index) in posts.data" :key="index">
                                    
                                    <td>{{post.id}}</td>
                                    
                                    <td>{{post.category ? post.category.name.substr(1,50) : '-'}}</td>
                                   
                                    <td>{{post.title.substr(0,10)}}</td>
                                    
                                    <td>{{post.body.substr(0,10)}}</td>
                                    
                                    <td><img :src="post.photo" class="img-fluid rounded rounded-4 shadow-sm " width="60" height="60" alt=""></td>
                                    
                                    <td>
                                        {{ post.user ? post.user.name : '-' }}
                                    </td>
                                    
                                    <td>{{post.added}}</td>
                                    
                                    <td>
                                        
                                        <a href="#" class="btn btn-primary btn-sm mx-1">
                                            <i class="fas fa-eye"></i>
                                         </a>

                                         <router-link  :to="{name:'EditPost',params:{id:post.id}}" class="btn btn-success btn-sm mx-1">
                                            <i class="fas fa-pencil"></i>
                                         </router-link>

                                         <!-- supprimer post -->
                                        <button class="btn btn-danger btn-sm" @click="deletePost(post.id)"><i class="fas fa-trash"></i></button>
                                       
                                    </td>
                                </tr>
                        </tbody>
                    </table>
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
            posts : {},
            loading :true,
          
        }
    },
    created(){
        this.getPosts()
    },
    methods : {
        getPosts(){
            axios.get('/api/posts')
            .then(response =>{
                this.posts = response.data

                console.log(response);
            })
            .catch(err => console.log(err));

           
        },
        deletePost(id){
            Swal.fire({
            title: 'Etes vous sure ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Supprimé!',
                'Post est bien supprimé',
                'success'
                )
                axios.delete('/api/posts/'+id)
                this.getPosts();
            }
            })
           
           
            
        }
       
    }
}
</script>

<style>

</style>