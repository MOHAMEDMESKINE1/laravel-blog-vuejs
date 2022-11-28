<template>
  <div>
    <div>
    <div class="container m-5">
      <div class="row">
        <div class="col-md-8 mx-auto ">
          <div class="card border-secondary mx-5">
              <div class="card-header"><h2 class="text-uppercase text-center p-2">Modifier Post</h2></div>
            <div class="card-body">
                
                <form @submit.prevent="updatePost" enctype="multipart/form-data">

                <div class="container-fluid">
                     <div class="form-floating mb-3">                                    
                        <select
                        class="form-select form-select" 
                        v-model="post.cetegory" 
                        
                        name="category" 
                        id="category">
                        <option selected disabled>Veuillez choisir une catégorie</option>
                            <option  
                            v-for="(category,index) in categories " :key="index"
                            :value="category.id"
                          
                            >
                            
                                    {{ category.name.substring(1,50) }}
                            </option>
                        
                        </select>
                    </div> 
                <div class="form-floating mb-3">
                <input 
                    
                    type="text"
                    v-model="post.title"
                    name="title"
                  
                    class="form-control" 
                    id="title" placeholder="Title">
                <label for="title">Title</label>
                </div>
                <div class="form-floating mb-3">
                <input 
                    @onchange="onImage"            
                    type="file"
                    name="image"
                    class="form-control" 
                    >
                
                </div>

                <div class="form-floating mb-3">
                <textarea
                    type="text"
                    class="form-control" 
                    v-model="post.body"
                    name="body"
                    id="body"
                    style="resize:none;"
                    placeholder="Body">
                </textarea>
                <label for="body">Body</label>
                </div>                
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <button type="reset" class="btn btn-secondary" >Annuler</button>
                
            </form>
            </div>
          </div>
      </div>

      </div>    
  </div>

  </div>

  </div>
</template>

<script>
export default {
    props :['id'],
    data(){
        return {
           post: {
            category:'',
            title:'',
            body:'',
          
           },
           image:'',
            categories : [],
         
        }
    },
    created(){
        axios.get('/api/categories')
            .then(response => {
                this.categories = response.data
                console.log(response.data);
            })
            axios.get('/api/posts/'+this.id)
            .then(response => {
                this.post = response.data
               
                // this.image = this.post.image
                console.log(response.data);
            })
    },
    methods : {
        onImage(e){
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        updatePost(){
            // Swal.fire({
            // title: 'Etes vous sure ?',
            // icon: 'warning',
            // showCancelButton: true,
            // confirmButtonColor: 'green',
            // cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes'
            // }).then((result) => {
            // if (result.isConfirmed) {
            //     Swal.fire(
            //     'Modifié!',
            //     'Post est bien modifié !',
            //     'success'
            //     )
                let formData = new FormData();

                formData.append('title',this.post.title);
                formData.append('body',this.post.body);
                formData.append('photo',this.post.image);
                formData.append('category_id',this.post.category);
                formData.append('_method','put');

                axios.patch('/api/posts/'+this.id)
                this.getPosts();

                // this.router.push({name:'admin'});
                this.$router.push('admin')
            // }
            // })
        }
    }
}
</script>

<style>

</style>