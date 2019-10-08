


require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

import axios from 'axios';
import VueAxios from 'vue-axios';

import VueRouter from 'vue-router';

//vuex store
import Vuex from 'vuex';
import {store} from './store';

import TextareaAutosize from 'vue-textarea-autosize'

// import is_admin from "./middleware/log_user";
import post_name from './components/Dashboard.vue';


Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);
Vue.use(TextareaAutosize);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app', require('./components/App.vue').default);
Vue.component('modal', require('./components/medical/ModalBlockList').default);
Vue.component('parents_modal', require('./components/medical/ParentsModalBlockList').default);
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
import PostsList from "./components/medical/PostsList";
import AddProcedures from "./components/medical/AddProcedures";
import BlockList from "./components/medical/BlockList";
import modal from "./components/medical/ModalBlockList";
import ExampleComponent from "./components/ExampleComponent";
import Expertise from "./components/Expertise";
import ExpertiseTest from "./components/ExpertiseTest";
import Admin from "./components/medical/Admin";
import MainHome from './components/MainHome'
import Test from './components/Test'
// console.log(is_admin);

axios.defaults.baseURL = 'http://localhost:/api';
const router = new VueRouter({

    mode: 'history',
    routes: [
        {


            path: '/',
            name: 'home',
            component: Home,
            children: [
                {
                    path: '/',
                    name: 'main_home',
                    component: MainHome,
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
                    //     auth: true
                    // }
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
                    path: '/expertise',
                    name: 'expertise',
                    component: Expertise,
                    props: true,
                },
                {
                    path: '/expertise_test',
                    name: 'expertise_test',
                    component: ExpertiseTest,
                    props: true
                },

                ]
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            children: [
                {
                    path: '/admin/add_new',
                    name: 'add_new',
                    component: AddNewPost
                },
                {
                    path: '/admin/add_content',
                    name: 'add_content',
                    component: AddContent
                },
                {
                    path: '/admin/posts',
                    name: 'posts',
                    component: PostsList
                },
                {
                    path: '/admin/add_procedures',
                    name: 'add_procedures',
                    component: AddProcedures
                },
                {
                    path: '/admin/block_list',
                    name: 'block_list',
                    component: BlockList
                },
                {
                    path: '/admin/example',
                    name: 'example',
                    component: ExampleComponent
                },

            ],
            beforeEnter: (to, from, next) => {

                // console.log(store.getters.IS_ADMIN);
              if(store.getters.IS_ADMIN==1)
              {
                  next({ })
              }
              else
              {
                  next({ path: '/' })
              }

                   }

        },
        {
            path: '/test',
            name: 'test',
            component: Test,
        },
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
    components: { App , modal},
     router,
     store,

});
