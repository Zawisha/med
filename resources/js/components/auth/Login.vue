<template>
    <div class="container">
        <div class="row" >
            <div class="col-2"></div>
            <div class="content_exp_test col-8">
                <div class="col-12">
                    <div class="alert alert-danger" v-if="error">
                        <p>Не верный логин или пароль</p>
                    </div>
                    <form autocomplete="off" @submit.prevent="login" Метод = «пост»>
                        <div class="form-group">
                            <label for="login_user">E-mail или никнейм</label>
                            <input type="text" id="login_user" class="form-control" placeholder="никнейм пользователя" v-model="login_user" required>
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
                error: false,
                login_user:''
            }
        },
        methods: {
            login(){

                var app = this
                this.$auth.login({
                    url: "/auth/login",
                    params: {
                        login_user: app.login_user,
                        password: app.password
                    },
                    success: function () {
                 // this.is_admin_add()
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
