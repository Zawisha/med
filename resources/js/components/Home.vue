<template>


<div>
    <body class="body">
    <div class="section">
        <div data-collapse="small" data-animation="over-right" data-duration="400" class="navbar w-nav">
            <div class="container w-container">
                <a href="/" class="brand w-nav-brand w--current">
                    <div class="logo">Юран | <span class="text-span">Beta</span></div>
                </a><nav role="navigation" class="nav-menu w-nav-menu"><a href="/" class="menu_botton w-nav-link w--current">Главная</a><a href="#" class="menu_botton w-nav-link">Услуги</a><a href="#" class="menu_botton w-nav-link">О сервисе</a><a href="#" class="menu_botton w-nav-link">О компании</a>
                <router-link v-if="$auth.check()" :to="{ name: 'admin' }"><a target="_blank" class="menu_botton-admin w-button">Админ панель</a></router-link>
                <router-link v-else :to="{ name: 'login' }"><a target="_blank" class="menu_botton-admin w-button">Вход в сервис</a></router-link>

            </nav>
                <div class="menu-button w-nav-button"><div class="icon w-icon-nav-menu"></div></div>
            </div></div></div>
    <router-view></router-view>
    </body>
</div>




</template>

<script>

    export default {
        data(){
            return {
                show_admin:true
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
