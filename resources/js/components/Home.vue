<template>
    <div class="container">
        <div class="row" >
            <div class="col-12 streak">
            </div>
        </div>
        <div class="col">

            <div class="row" >
                <div class="col-2"></div>
                <div class="content_exp_test col-8">
                    <div class="col-12 d-flex header_exp_test">
                        <div class="col-6 "> <a href="/" ><img :src="'/img/logo.png'"  class="header_img" alt="logo" ></a></div>
                        <div v-if="$auth.check()" class="col-4 like_button_top "><router-link class="text-center like_button" :to="{ name: 'admin' }">Админ</router-link></div>
                        <div v-else class="col-2 text-center exp_header_text_us"></div>
                        <div v-if="$auth.check()" class="col-4 like_button_top"><a class="text-center like_button" href="#" @click.prevent="$auth.logout()">Выйти</a></div>
                        <div v-else class="col-4 like_button_top" ><router-link class=" text-center like_button" :to="{ name: 'login' }">Вход в сервис</router-link></div>
                    </div>
                    <div class="col-12">
                        <div class="text-center my-4"><h3>Помощник для бизнеса по вопросам согласования документов с МАРТ</h3></div>
                    </div>
                    <router-view></router-view>
                    <div class="col-4 block_exp_text">
                        <div class="col-12 justify-content-center exp_text"><b>Экспертиза планируемой сделки</b></div>
                        <div class="col-12 justify-content-center">Пройдите экспертизу и узнайте необходимо ли Вам обращаться в МАРТ для совершения сделки</div>
                        <div class="col-12 go_to_exp_text "><router-link class="go_to_exp_text_color" :to="{ name: 'expertise' }">Пройти экспертизу &#8594</router-link></div>
                    </div>
                </div>
                <div class="col-2">
                </div>
            </div>
            <div class="row"></div>

<!--            <router-link :to="{ name: 'register' }">Register</router-link>-->

        </div>
    </div>

</template>

<script>

    export default {
        data(){
            return {

            }
        },
        mounted() {
this.is_admin_add();
        },
        created(){
        },
        methods: {

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
