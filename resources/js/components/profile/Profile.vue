<template>


    <div>
        <body class="body-2">
            <div class="section">
                 <div class="div-screen-1">
                <div class="div-block-8">
                    <a class="menu_botton-admin w-button profile_button" v-on:click="goto_my_doc">Мои документы</a>
                    <a class="menu_botton-admin w-button profile_button" v-if="is_admin=='1'" v-on:click="goto_admin">Панель администратора</a>
                    <button type="button" class="btn btn-info" v-on:click="exit_from_acc">Выйти</button>
                </div>
             </div>
                <router-view></router-view>
        </div>
        </body>
<!--        <button class="menu_botton-admin w-button profile_button"  v-on:click="test">test</button>-->

    </div>

</template>

<script>

    export default {

        data(){

            return {
                is_admin:'0'
            }
        },
        mounted() {
          this.is_admin_add();
        },
        methods: {

            test()
            {
          console.log(this.is_admin);
            },
            goto_my_doc()
            {
                Vue.router.push({name:'my_doc'});

            },
            goto_admin()
            {
                Vue.router.push({name:'admin'});
            },


            is_admin_add()
            {
                axios.get('/is_admin').then(({ data }) => (
                        this.is_admin=data,
                this.$store.dispatch('setIsAdmin', data)

                    )
                )
            },

            exit_from_acc()
            {
                axios.post('/auth/logout').then(({ data }) => (
                    window.location.href = "http://localhost"
                    )

                )

            }




        },

    }
</script>


