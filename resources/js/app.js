require('./bootstrap');
import Vue from 'vue'
window.Vue = require('vue');
import Vuex from 'vuex';

Vue.use(Vuex);


import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';


Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);
window.axios = require('axios');



const router = new VueRouter({
    base: '/app',
    mode: 'history',
    routes: routes
});




const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
