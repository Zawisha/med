import ForgetPasswordJuran from "./components/auth/ForgetPasswordJuran";


require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

import axios from 'axios';
import VueAxios from 'vue-axios';

import VueRouter from 'vue-router';

// import Autocomplete  from 'vuejs-auto-complete';
// Vue.component('autocomplete', Autocomplete);

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);
import 'vue-select/dist/vue-select.css';


//vuex store
import Vuex from 'vuex';
import {store} from './store';

import TextareaAutosize from 'vue-textarea-autosize'

// import is_admin from "./middleware/log_user";
import post_name from './components/Dashboard.vue';

import vPagination from 'vue-plain-pagination'
Vue.component('v-pagination', vPagination);


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
import Document from './components/document/Document'
import GetDocument from "./components/document/GetDocument";
import PrepareDocument from "./components/document/PrepareDocument";
import DocumentSubject from "./components/document/DocumentSubject";
import FormDocument from "./components/document/FormDocument";
import DealDocument from "./components/document/DealDocument";
import Profile from "./components/profile/Profile";
import Document1 from "./components/document/document_list/Document1";
import Document2 from "./components/document/document_list/Document2";
import MyDocument from "./components/profile/MyDocument";
import UsersList from "./components/medical/UsersList";
import LoginJuran from "./components/auth/LoginJuran";
import RegisterJuran from "./components/auth/RegisterJuran";


axios.defaults.baseURL = 'http://localhost:/api';
// axios.defaults.baseURL = 'http://mart.juran.by:/api';
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
                {
                    path: '/doc',
                    name: 'doc',
                    component: Document,
                },
                {
                    path: '/get_doc',
                    name: 'get_doc',
                    component: GetDocument,
                },
                {
                    path: '/prep_doc',
                    name: 'prep_doc',
                    component: PrepareDocument,
                    props: true,
                },
                {
                    path: '/doc_subject',
                    name: 'doc_subject',
                    component: DocumentSubject,
                    props: true,
                },
                {
                    path: '/form_doc',
                    name: 'form_doc',
                    component: FormDocument,
                },
                {
                    path: '/deal_doc',
                    name: 'deal_doc',
                    component: DealDocument,
                },
                {
                    path: '/document1',
                    name: 'document1',
                    component: Document1,
                },
                {
                    path: '/document2',
                    name: 'document2',
                    component: Document2,
                },
                {
                    path: '/forget_pass_juran',
                    name: 'forget_pass_juran',
                    component: ForgetPasswordJuran,
                },
                {
                    path: '/profile',
                    name: 'profile',
                    component: Profile,
                    children: [
                        {
                            path: '/my_doc',
                            name: 'my_doc',
                            component: MyDocument,
                        },
                        ]
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
                {
                    path: '/admin/users_list',
                    name: 'users_list',
                    component: UsersList
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
        {
            path: '/login_juran',
            name: 'login_juran',
            component: LoginJuran,
        },
        {
            path: '/register_juran',
            name: 'register_juran',
            component: RegisterJuran,
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
