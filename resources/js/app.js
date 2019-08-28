

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

import axios from 'axios';
import VueAxios from 'vue-axios';

import VueRouter from 'vue-router';

//vuex store
import Vuex from 'vuex';
import {store} from './store';


Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app', require('./components/App.vue').default);

// шина данных
export var postName = new Vue();


import App from './components/App'
import Home from './components/Home'
import Register from './components/auth/Register.vue';
import Login from './components/auth/Login.vue';
import Dashboard from './components/Dashboard.vue';
import AcceptToken from './components/AcceptToken.vue';
import ForgetPassword from './components/auth/ForgetPassword.vue';
import RenewPassword from './components/auth/RenewPassword.vue';
import AddNewPost from "./components/medical/AddNewPost";
import AddContent from "./components/medical/AddContent";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register,

        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
           // meta: {
               // auth: true
         //   }
        },
        {
            path: '/accept/:token',
            name: 'accept',
            component: AcceptToken
        },
        {
            path: '/forget',
            name: 'forget',
            component: ForgetPassword
        },
        {
            path: '/renew_password/:id/:token',
            name: 'renew_pass',
            component: RenewPassword
        },
        {
            path: '/admin/add_new',
            name: 'add_new',
            component: AddNewPost
        },
        {
            path: '/admin/add_content',
            name: 'add_content',
            component: AddContent
        }


    ],
});

Vue.router = router;
//websanova/vue-auth
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

const app = new Vue({
    el: '#app',
    components: { App },
     router,
     store,
});
