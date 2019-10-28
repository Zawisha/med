<template>
        <div>
   <body class="body-3">
   <div class="divlogin">
       <div class="div-block-20">
           <div class="div-block-19">
               <div>
               <div class="div-block-back">
                   <a href="/" target="_blank" class="w-inline-block">
                       <img src="https://uploads-ssl.webflow.com/5d93c99b337fd39ab87ef61a/5dab6718f43e6f6c56dc1fbc_arrow_back.svg" width="28" alt="" class="image-5"/></a>
                   <router-link  :to="{ name:'forget_pass_juran'}"><a href="" class="link-3">Не помню пароль</a></router-link>
               </div>
                   <a href="/" class="link">Юран</a>
                   <div class="text-block-8">Войдите, чтобы продолжить</div>
                   <div class="w-form">
                       <form id="wf-form-Enter-login" name="wf-form-Enter-login" data-name="Enter login" class="form" @submit.prevent="login">
                           <input v-model="login_user" type="text" class="text-field w-input" maxlength="256" data-name="Имя логина или почты" placeholder="Введите почту" id="node"/>
                           <input v-model="password" type="password" class="text-field w-input" maxlength="256" data-name="Пароль" placeholder="Введите пароль" id="node-2" required=""/>
                           <input type="submit" value="Войти" data-wait="Ожидайте..." class="button-3 w-button"/>
                       </form>
                       <div class="alert alert-danger login_alert" v-if="error">
                           <p>Не верный логин или пароль</p>
                       </div>
                       <div class="success-message w-form-done">
                           <div class="text-block-9">Добро пожаловать <br/>в личный кабинет!</div>
                       </div>
                   </div>
                   <router-link  :to="{ name: 'register_juran' }">
                       <a href="" class="button-4 w-button">Зарегистрироваться</a>
                   </router-link>
               </div>
           </div>
       </div>
       <div class="div-block-18">
           <a href="#" class="loglink">Поддержка</a>
           <a href="/" class="loglink">Юран, 2019</a>
       </div>
   </div>
   </body>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                email: null,
                password: null,
                error: false,
                login_user:''
            }
        },
        methods: {
            login(){

                this.error = false;

                var app = this
                this.$auth.login({
                    url: "/auth/login",
                    params: {
                        login_user: app.login_user,
                        password: app.password
                    },
                    success: function () {
                    },
                    error: function () {
                        this.error = true;
                    },
                    rememberMe: true,
                    redirect: '/',
                    fetchUser: true,
                });
            },

        }
    }
</script>
