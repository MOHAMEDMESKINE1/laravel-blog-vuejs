<template>
 <div>
    <div class="card w-100 ">
            <div class="card-header"><h1>Catégories</h1></div>
            <div class="card-body  ">
            <!-- Hover added -->
                <div class="list-group mb-3"  v-for="category in categories" :key="category.id">

                    <router-link :to="{name:'PostCategory', params:{slug:category.slug} }" 
                    class="list-group-item list-group-item-action active">
                        {{category.name}}
                    </router-link>
                    <!-- <router-link :to="`/posts/category/${category.slug}`" 
                    class="list-group-item list-group-item-action active">
                        {{category.name}}
                    </router-link> -->
                   
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
                    categories : []
                }
        },

    mounted(){
        this.getCategories()
    },
    methods : {
        getCategories(){
            axios.get('/api/categories')
            .then(response =>this.categories = response.data)
        }
    }
}
</script>
<style>

</style>