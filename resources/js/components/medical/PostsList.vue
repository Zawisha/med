<template>
    <div class="col">

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col-8">Название поста</th>
                <th scope="col-2"></th>
                <th scope="col-2"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts">
                <td scope="col-8">
                    {{ post.text }}
                </td>
                <td scope="col-2"><button type="button" class="btn btn-secondary" v-on:click="edit_post(post.id_post)">Редактировать</button></td>
                <td scope="col-2"><button type="button" class="btn btn-danger" v-on:click="delete_post(post.id_post)">Удалить</button></td>
            </tr>

            </tbody>
        </table>


    </div>
</template>
<script>

    import {postName} from "../../app.js";
    export default {

        data(){

            return {
                posts: [],
            }
        },
        mounted() {


            this.render_table(this.posts);


        },
        methods: {

            render_table(inp)
            {
                axios
                    .post('/api/render_posts',{
                        parent:this.current_line,
                    }).then(({ data }) => (
                        data.forEach(function(entry) {
                            inp.push({
                                text:entry.name_post,
                                id_post:entry.id_post,
                            });
                        })
                    )
                );
            },

            select_line(numb)
            {
                axios
                    .post('/api/select_line',{
                        id_post:numb,
                    })
                    .then(({ data }) => (
                    this.$store.dispatch('setLineCounter', data)
                    )
               );
            },
            select_name(numb)
            {
                axios
                    .post('/api/select_name',{
                        id_post:numb,
                    })
                    .then(({ data }) => (
                       this.$store.dispatch('changeName', data.name_post)
                        )
                    );
            },


            edit_post(numb)
            {
                //выбираю номер линии у поста
                this.select_line(numb);
               this.select_name(numb);
                //меняю значение поста
                this.$store.dispatch('setPostCounter', numb);
                //имя поста
                Vue.router.push({name:'add_content'});
            },
            delete_post(numb)
            {

            }


        },

    }
</script>
