import Vue from 'vue'
import Index from './components/Index.vue';
import Create from './components/Create.vue';
import Login from './components/Auth/Login.vue';
import Registration from './components/Auth/Register.vue';

Vue.component('app', require('./App.vue').default);

export const routes = [
    {
        name: 'register',
        path: '/register',
        component: Registration,
        meta: {title: 'Регистрация'}
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {title: 'Вход'}
    },
    {
        name: 'home',
        path: '/',
        component: Index,
        meta: {title: 'Главная'}
    },
    {
        name: 'create',
        path: '/create',
        component: Create,
        meta: {title: 'Create'}
    },


];
