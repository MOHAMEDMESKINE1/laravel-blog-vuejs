import Vue from 'vue';
import VueRouter  from 'vue-router';

import Home from '../components/Home'
import PostDetails from '../components/PostDetails'
import Categories from '../components/Categories'
import PostCategory from '../components/PostCategory'

// auth
import Login from '../components/auth/Login'
import Register from '../components/auth/Register'
import Logout from '../components/auth/Logout'

// Admin
import AdminPanel from '../components/Admin/AdminPanel'
import EditPost from '../components/Admin/EditPost'

Vue.use(VueRouter);

const routes = [
    {
        path:'/',
        name:'home',
        component : Home
    },
    {
        path:'/categories',
        name:'categories',
        component : Categories
    },
    {
        path:'/post/:id',
        name:'PostDetails',
        component : PostDetails,
        props : true
    },
    {
        path:'/posts/category/:slug',
        name:'PostCategory',
        component : PostCategory,
        props:true
        
    },
    // auth
    {
        path:'/login',
        name:'login',
        component : Login
    },
    {
        path:'/register',
        name:'register',
        component : Register
    },
    {
        path:'/logout',
        name:'logout',
        component : Logout
    },
    // admin
    {
        path:'/admin',
        name:'admin',
        component : AdminPanel
    },
    {
        path:'/post/edit/:id',
        name:'EditPost',
        component : EditPost,
        props : true 
     }
]

const router = new VueRouter({

    hashbang : false,
    mode : 'history',
    routes
})

export default router