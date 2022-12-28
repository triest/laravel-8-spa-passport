import Vue from 'vue'
import Index from './components/Index.vue';
import Create from './components/Create.vue';

Vue.component('app', require('./App.vue').default);

export const routes = [

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
