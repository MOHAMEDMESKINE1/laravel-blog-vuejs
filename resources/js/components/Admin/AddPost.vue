<template>
  <div>
    <a href="#" class="btn btn-sm btn-success text-white mb-2"
                data-bs-toggle="modal" 
                data-bs-target="#addPost"
                >
                    <i class="fas fa-plus"></i>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">Ajouter un Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                            <div class="modal-body">

                                <form @submit.prevent="addPost" enctype="multipart/form-data">

                                <div class="container-fluid">
                                    <div class="form-floating mb-3">                                    
                                        <select
                                         class="form-select form-select" 
                                         v-model="category" 
                                         
                                         name="category" 
                                         id="category">
                                         <option selected disabled>Veuillez choisir une catégorie</option>
                                            <option  
                                             v-for="(category,index) in categories " :key="index"
                                             :value="category.id"
                                             >
                                            
                                                    {{category.name.substring(1,50)}}
                                            </option>
                                        
                                        </select>
                                    </div>
                                  <div class="form-floating mb-3">
                                   <input 
                                    
                                     type="text"
                                     v-model="title"
                                     name="title"
                                     class="form-control" 
                                       id="title" placeholder="Title">
                                   <label for="title">Title</label>
                                 </div>
                                  <div class="form-floating mb-3">
                                   <input 
                                     
                                     @change="onImage"
                                    
                                     type="file"
                                     name="image"
                                     class="form-control" 
                                     >
                                  
                                 </div>

                                 <div class="form-floating mb-3">
                                   <textarea
                                     type="text"
                                     
                                      class="form-control" 
                                      v-model="body"
                                      name="body"
                                      id="body"
                                      style="resize:none;"
                                       placeholder="Body">
                                  </textarea>
                                   <label for="body">Body</label>
                                 </div>

                               
                                  
                              </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" @click="addPost" >Save</button>

                                </form>
                            </div>
                            <!-- <div class="modal-footer">
                            </div> -->
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
            body:'',
            title:'',
            category:'',
            categories:[],
            image : null,
            user_id : User.isLogged().id
        }
    },
    created(){
            axios.get('/api/categories')
            .then(response => {
                this.categories = response.data
                console.log(response.data);
            })
    },
    methods : {
        onImage(e){
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
          
        },
        addPost(){

            const config = {
                headers :{'content-type': 'multipart/form-data'}
            }

            let formData = new FormData();
            formData.append('title',this.title);
            formData.append('body',this.body);
            formData.append('photo',this.image);
            formData.append('category_id',this.category);
            // formData.append('user_id',this.user_id);


            try{
                axios.post('/api/posts/',formData,config)
                .then(response =>{
                    console.log(response.data)

                    // Swal.fire({
                    // position: 'center',
                    // icon: 'success',
                    // title: 'Post bien ajouté',
                    // showConfirmButton: false,
                    // timer: 1500
                    // })
                    this.$emit('added')


                }).catch(err=> console.log(err))
                }catch(err){
                    console.log(err.message);
                }
           
            // clear fields 
            this.body=''
            this.title=''
            this.category=''

            // refresh data
            axios.get('/api/posts')
            .then(response =>{
                this.posts = response.data

                console.log(response);
            })
            .catch(err => console.log(err));

        }
    }
}
</script>

<style>

</style>