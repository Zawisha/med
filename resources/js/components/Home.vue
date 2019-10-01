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
                    <div class="col-12 d-flex header_exp_test ">
                        <div class="col-4 col-md-2 "> <a href="/" ><img :src="'/img/logo.png'"  class="header_img" alt="logo" ></a></div>
                        <div v-if="$auth.check()" class="col-4 col-md-6 text-center exp_header_text_us"><router-link :to="{ name: 'admin' }">Admin</router-link></div>
                        <div v-else class="col-4 col-md-4 text-center exp_header_text_us"></div>
                        <div v-if="$auth.check()" class="col-4 col-md-6 text-center exp_header_text_us"><a href="#" @click.prevent="$auth.logout()">Logout</a></div>
                        <div v-else class="col-4 col-md-6 text-center exp_header_text_us"><router-link :to="{ name: 'login' }">Вход в сервис</router-link></div>
                    </div>
                    <div class="col-12">
                        <div class="text-center my-4">Помощник для бизнеса по вопросам согласования документов с МАРТ</div>
                    </div>
                    <router-view></router-view>
                    <router-link :to="{ name: 'expertise' }">Пройти экспертизу</router-link>
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
