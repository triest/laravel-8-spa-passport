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
import { CreateApp} from 'vue'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);
window.axios = require('axios');
import {store} from './store/index';

Vue.prototype.$isLogin = false;

Vue.prototype.$appName = 'My App'

const router = new VueRouter({
    base: '/app',
    mode: 'history',
    routes: routes
});



const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    render: h => h(App),
});

