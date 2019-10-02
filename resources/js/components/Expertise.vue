<template>

    <div class="container">

        <div class="row" >
            <div class="col-12 streak">
            </div>
        </div>
        <div class="row" >
            <div class="col-2"></div>
            <div class="content_exp_test col-12">
                <div class="col-12 d-flex header_exp_test ">
                    <div class="col-4 col-md-2 "> <a href="/" ><img :src="'/img/logo.png'"  class="header_img" alt="logo" ></a></div>
                    <div class="col-4 col-md-4 text-center exp_header_text_us">
                        Экспертиза
                    </div>

                    <div v-if="$auth.check()" class="col-4 like_button_top"><a class="text-center like_button" href="#" @click.prevent="$auth.logout()">Выйти</a></div>
                    <div v-else class="col-4 like_button_top" ><router-link class=" text-center like_button" :to="{ name: 'login' }">Вход в сервис</router-link></div>
                </div>
                    <div class="col-12">
                        <div class="text-center my-4">{{ post_name }}</div>
                        <div class="list-counter-square " style="max-width: 1200px; margin: 0 auto;" >
                            <div class="front_expertise_list" v-for="(post, number) in posts" v-on:click="go_to_expertise_test(post.id_procedure,post.text)">{{ post.text }}</div>
                        </div>
                    </div>
            </div>
            <div class="col-2">
            </div>
        </div>

<!--        <button type="button" class="btn btn-primary btn-block" v-on:click="test">test</button>-->

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

