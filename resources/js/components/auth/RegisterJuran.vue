<template>
    <div >
        <body>
        <div class="section-3">
            <div class="div-screen-reg-1">
                <div class="columns-3 w-row">
                    <div class="column-7 w-col w-col-6">
                        <div class="div-block-23">
                            <a href="/" class="heading-kur">juran.by</a>
                            <p class="paragraph-2">Юридический ангел</p>
                            <div class="text-block-11">Сервис созданный юристами для юристов.<br/>Упрощайте и автоматизируйте<br/>работу с документами.</div>
                            <div class="div-block-24">
                                <a href="#" class="loglink-reg">Поддержка</a>
                                <a href="/" class="loglink-reg">Юран</a>
                            </div>
                        </div>
                    </div>
                    <div class="column-8 w-col w-col-6">
                        <div class="div-block-registr">
                            <div class="div-block-19">
                                <div>
                                    <div class="div-blockr-reg">
                                        <h1 class="heading-reg">Регистрация</h1>
                                    </div>
                                    <div class="w-form">
                                    <form @submit.prevent="register" v-if="!success" id="wf-form-Enter-login" name="wf-form-Enter-login" data-name="Enter login" class="form">
                                        <input type="text" class="text-field w-input" maxlength="256" data-name="Имя" placeholder="Введите имя" id="node-3" v-model="name" />
                                        <input type="text" class="text-field w-input" maxlength="256" data-name="Фамилия" placeholder="Фамилия" id="node-4" v-model="surname" />
                                        <input type="email" maxlength="256" data-name="Почта" placeholder="Электронная почта" id="node-5" class="text-field w-input" v-model="email" />
                                        <input type="password" class="text-field w-input" maxlength="256" data-name="Пароль" placeholder="Придумайте пароль" id="node-6" v-model="password" />
                                        <input type="password" class="text-field w-input" maxlength="256" data-name="Повтор пароля" placeholder="Повторите пароль" id="node-7" v-model="conf_password" />
                                        <input type="tel" class="text-field w-input" maxlength="256" data-name="Номер телефона" placeholder="Номер мобильного телефона" id="node-8" v-model="telefon" />
                                        <input type="submit" value="Зарегистрироваться" data-wait="Ожидайте..." class="button-3 w-button"/>
                                        <div class="div-block-25">
                                            <div class="text-block-12">У вас есть аккаунт?</div>
                                            <a href="/login" class="link-4">Войти</a>
                                        </div>
                                    </form>
                                    <div class="alert alert-success" v-if="success">
                                        <p>Вам на почту выслано письмо для подтверждения регистрации. Спасибо.</p>
                                    </div>
                                    <div class="success-message w-form-done">
                                        <div class="text-block-9">Добро пожаловать <br/>в личный кабинет!</div>
                                    </div>
                                    <div class="error-message w-form-fail">
                                        <div class="text-block-10">Неверный пароль!</div>
                                    </div>
                                        <div class="alert alert-danger" v-if="error">
                                            <ul id="v-for-object" class="demo" v-if="!conf_password_er"> <li v-for="value in error_arr"> {{ value[0] }} </li> </ul>
                                            <ul id="v-for-object_er" class="demo" v-if="conf_password_er"> <li v-for="value in error_arr"> {{ value }} </li> </ul>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name: '',
                surname:'',
                email: '',
                password: '',
                conf_password:'',
                conf_password_er:false,
                telefon:'',
                error: false,
                errors: {},
                success: false,
                error_arr:{},
                error_arr_new:{},


            };
        },
        methods: {
            register() {
                this.errors=[];
                this.error = false;
                this.conf_password_er=false;
                if (this.password !== this.conf_password) {
                    this.error = true;
                    this.conf_password_er=true,
                    this.error_arr[0] = 'Пароли не совпадают';
                } else {

                var app = this;
                this.$auth.register({
                    url: "/auth/register",
                    data: {
                        name: app.name,
                        surname: app.surname,
                        email: app.email,
                        telefon: app.telefon,
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
