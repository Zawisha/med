<template>
    <div class="container">
        <div class="col">
                <h1 class="h5 text-center my-4">Выберите экспертизу</h1>
                <ol class="list-counter-square" style="max-width: 300px; margin: 0 auto;" >
                    <li v-for="(post, number) in posts" v-on:click="go_to_expertise_test(post.id_procedure,post.text)">{{ post.text }}</li>
                </ol>
        </div>
        <button type="button" class="btn btn-primary btn-block" v-on:click="test">test</button>
    </div>

</template>

<script>

    export default {

        data(){

            return {
                //главный массив постов
                posts: [],

            }
        },
        mounted() {
            this.render_table(this.posts);
        },
        methods: {

            test()
            {
                console.log(this.posts);
            },

            render_table(inp)
            {
                axios
                    .post('/api/front_render_procedures',{
                    }).then(({ data }) => (
                                data.forEach(function(entry) {
                                inp.push({
                                    text:entry.name_main_procedure,
                                    id_procedure:entry.id_main_procedure,
                                });
                            })
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

    .list-counter-square>li {
        position: relative;
        display: block;
        height: 2rem;
        line-height: 2rem;
        margin-left: 1.75rem;
        margin-bottom: .25rem;
        padding-left: 1rem;
        padding-right: .5rem;
        color: #fff;
        background: #7b1fa2;
        white-space: nowrap;
        border-radius: .25rem
    }

    .list-counter-square>li:last-child {
        margin-bottom: 0;
    }

    .list-counter-square>li::before {
        content: counter(list);
        counter-increment: list;
        position: absolute;
        left: -2rem;
        top: -.25rem;
        bottom: -.25rem;
        width: 2.5rem;
        line-height: 2rem;
        border-radius: 1.25rem;
        border: .25rem solid #fff;
        text-align: center;
        color: #fff;
        background: #7b1fa2;
    }
</style>
