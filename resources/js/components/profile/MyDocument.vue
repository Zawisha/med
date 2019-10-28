<template>


    <div>
        <body class="body-2">
            <div class="section">
                 <div class="div-screen-1">
                <div class="div-block-8">
                    <a class="button-5 w-button" v-on:click="goto_my_doc">Мои документы</a>

                    <a class="button-5 w-button" v-on:click="">Панель администратора</a>

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
                //главный массив постов
                posts: [],
                post_name:''
            }
        },
        mounted() {

           // this.post_name=this.posts[0]['name_post'];
        },
        methods: {

            goto_my_doc()
            {
                Vue.router.push({name:'expertise_test'});

            },

            test()
            {
                // axios
                //     .post('/test',{
                //     })
            },




        },

    }
</script>
<style>
    .list-counter-square {
        list-style: none;
      counter-reset: list;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .list-counter-square>div {
        position: relative;
        display: block;
        /*height: 2rem;*/
        line-height: 2rem;
        margin-left: 1.75rem;
        margin-bottom: .25rem;
        padding-left: 1rem;
        padding-right: .5rem;
        color: #fff;
        background: #55a79a;
        /*white-space: nowrap;*/
        border-radius: .25rem
    }

    .list-counter-square>div:last-child {
        margin-bottom: 0;
    }

    .list-counter-square>div::before {
        content: counter(list);
        counter-increment: list;
        position: absolute;
        left: -2rem;
        top: -.25rem;
        bottom: -.25rem;
        width: 2.5rem;
        height: 2.5rem;
        line-height: 2rem;
        border-radius: 1.25rem;
        border: .25rem solid #fff;
        text-align: center;
        color: #fff;
        background: #55a79a;
    }
</style>

