<template>


    <div>
        <body class="body-2">
            <div class="section">
                 <div class="div-screen-1">
                <div class="div-block-8">
                        Ваш аккаунт забанен
                </div>
             </div>
                <router-view></router-view>
        </div>
        </body>
    </div>

</template>

<script>

    export default {

        data(){

            return {

            }
        },
        mounted() {

        },
        methods: {

            test()
            {
          console.log(this.is_admin);
            },

        },

    }
</script>


