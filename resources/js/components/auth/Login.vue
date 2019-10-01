<template>
    <div class="container">
        <div class="row" >
            <div class="col-2"></div>
            <div class="content_exp_test col-8">
                <div class="col-12 d-flex header_exp_test ">
                    <div class="col-4 col-md-2 "> <a href="/" ><img :src="'/img/logo.png'"  class="header_img" alt="logo" ></a></div>
                    <div class="col-4 col-md-4 text-center exp_header_text_us">
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center my-4">Помощник для бизнеса по вопросам согласования документов с МАРТ</div>
                </div>
                <div class="col-12">
                    <div class="alert alert-danger" v-if="error">
                        <p>Не верный логин или пароль</p>
                    </div>
                    <form autocomplete="off" @submit.prevent="login" Метод = «пост»>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" id="password" class="form-control" v-model="password" required>
                        </div>
                        <button type="submit" class="btn btn-default">Войти</button>
                    </form>
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>






    </div>
</template>
<script>
    export default {
        data(){
            return {
                email: null,
                password: null,
                error: false
            }
        },
        methods: {
            login(){

                var app = this
                this.$auth.login({
                    url: "/auth/login",
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                 this.is_admin_add()
                    },
                    error: function () {
                        this.error = true;
                    },
                    rememberMe: true,
                    redirect: '/',
                    fetchUser: true,
                });
            },

            is_admin_add()
            {
                axios.get('/is_admin').then(({ data }) => (

                    this.$store.dispatch('setIsAdmin', data)

                    )
                )
            }

        }
    }
</script>
