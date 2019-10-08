<template>


    <div>
        <body class="body-2">
            <div class="section">
                 <div class="div-screen-1">
                <div class="div-block-8">
            <h1 class="heading">Экспертиза сделки</h1>
            <p class="paragraph exp">{{ post_name }}</p>
            <a class="button-5 w-button" v-for="(post, number) in posts" v-on:click="go_to_expertise_test(post.id_procedure,post.text)">{{ post.text }}</a>
                </div>
             </div>
        </div>
    <div class="section-2">
        <div class="div-block-7">
            <div class="columns w-row">
                <div class="w-col w-col-6"><div><div class="text-block">  © Все права защищены</div>
                </div>
                </div>
                <div class="w-col w-col-6">

        </div></div></div></div>
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
            this.render_table(this.posts);
           // this.post_name=this.posts[0]['name_post'];
        },
        methods: {

            test()
            {
                // axios
                //     .post('/test',{
                //     })
            },

            render_table(inp)
            {
                axios
                    .post('/front_render_procedures',{
                    }).then(({ data }) => (
                                data.forEach(function(entry) {
                                inp.push({
                                    text:entry.name_main_procedure,
                                    id_procedure:entry.id_main_procedure,
                                    name_post:entry.name_post
                                })
                            }),
              this.post_name=this.posts[0]['name_post']
                    )

                );
            },

            go_to_expertise_test(numb, text)
            {
                Vue.router.push({name:'expertise_test', params: { front_procedure_id:numb, front_text_procedure:text}});
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

