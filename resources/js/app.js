require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import IndexComponent from './components/Main.vue';

import IndexComponentTruk from './components/truks/Index.vue';
import CreateComponentTruk from './components/truks/Create.vue';
import EditComponentTruk from './components/truks/Edit.vue';

import IndexComponentItem from './components/items/Index.vue';
import CreateComponentItem from './components/items/Create.vue';
import EditComponentItem from './components/items/Edit.vue';

import IndexComponentRental from './components/rentals/Index.vue';
import CreateComponentRental from './components/rentals/Create.vue';
import DetailComponentRental from './components/rentals/Detail.vue';

import CreateComponentCargo from './components/cargos/Create.vue';

const routes = [
    {
        name: 'main',
        path: '/',
        component: IndexComponent
    },
    {
        name: 'list-truk',
        path: '/list-truk',
        component: IndexComponentTruk
    },
    {
        name: 'create-truk',
        path: '/create-truk',
        component: CreateComponentTruk
    },
    {
        name: 'edit-truk',
        path: '/edit-truk/:id',
        component: EditComponentTruk
    },
    {
        name: 'list-item',
        path: '/list-item',
        component: IndexComponentItem
    },
    {
        name: 'create-item',
        path: '/create-item',
        component: CreateComponentItem
    },
    {
        name: 'edit-item',
        path: '/edit-item/:id',
        component: EditComponentItem
    },
    {
        name: 'list-rental',
        path: '/list-rental',
        component: IndexComponentRental
    },
    {
        name: 'create-rental',
        path: '/create-rental',
        component: CreateComponentRental
    },
    {
        name: 'detail-rental',
        path: '/detail-rental/:id',
        component: DetailComponentRental
    },
    {
        name: 'create-cargo',
        path: '/create-cargo/:id',
        component: CreateComponentCargo
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');