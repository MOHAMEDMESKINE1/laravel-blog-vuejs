require('./bootstrap');

//  window.Vue = require('vue');
import Vue from 'vue'
import router from './routes/routes.js'
// import pagination from 'laravel-vue-pagination';

import User from './helpers/User';
window.User = User;


Vue.component('app-home',require('./AppHome.vue').default);
Vue.component('navbar-component', require('./Navbar').default);
Vue.component('categories', require('./components/Categories').default);
Vue.component('add-post', require('./components/Admin/AddPost').default);
// Vue.component('pagination',require('laravel-vue-pagination'));
// Vue.component('pagination', pagination)
const app = new Vue({
    el: '#app',
    router
});
