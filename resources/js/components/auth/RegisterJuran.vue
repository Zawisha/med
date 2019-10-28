<template>
    <div class="container">
        <div class="row" >
            <div class="col-2"></div>
            <div class="content_exp_test col-8">
        <div class="alert alert-danger" v-if="error">
           <p>There was an error, unable to complete registration.</p>

            <ul id="v-for-object" class="demo"> <li v-for="value in error_arr"> {{ value[0] }} </li> </ul>
        </div>
        <div class="alert alert-danger" v-if="conf_password_alert">
            <p>Пароли не совпадают</p>
        </div>
        <div class="alert alert-danger" v-if="success">
            <p>Вам выслано письмо для подтверждения регистрации. Спасибо.</p>
        </div>
        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" class="form-control" v-model="name" required>
            </div>
            <div class="form-group" >
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>

            </div>
            <div class="form-group" >
                <label for="password">Пароль</label>
                <input type="password" id="password" class="form-control" v-model="password" required>

            </div>
            <div class="form-group" >
                <label for="conf_password">Повторите пароль</label>
                <input type="password" id="conf_password" class="form-control" v-model="conf_password" required>
            </div>
<!--            <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">-->
<!--                <label for="conf_password">Повторите пароль</label>-->
<!--                <input type="password" id="conf_password" class="form-control" v-model="conf_password" required>-->
<!--                <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>-->
<!--            </div>-->
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
         </div>
            <div class="col-2"></div>
      </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name: '',
                email: '',
                password: '',
                conf_password:'',
                conf_password_alert:false,
                error: false,
                errors: {},
                success: false,
                error_arr:{},
                error_arr_new:{},
            };
        },
        methods: {
            register() {
                this.error = false;
                this.conf_password_alert=false;
                if (this.password !== this.conf_password) {
                    this.conf_password_alert=true;
                } else {


                var app = this;

                this.$auth.register({
                    url: "/auth/register",
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                        conf_password: app.conf_password
                    },
                    success: function (resp) {

                        if (resp.data.status == 'fail') {
                            this.error = true;
//to array
                            this.error_arr_new = Object.entries(resp.data);
                            this.error_arr = this.error_arr_new[0][1];

                        } else {
                            this.error = false;
                            app.success = true;

                        }


                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp;

                    },
                    redirect: null
                });
                // END IF
            }
            }
        }
    }
</script>
