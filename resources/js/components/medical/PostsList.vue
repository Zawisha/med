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

        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item page-link disabled " v-on:click="prev">Previous</li>
                <li class="page-item page-link " v-for="page in pagination" v-on:click="numb_pagination(page - 1)" v-if="active_page == page ">
                    {{ page }}
                </li>
                <li class="page-item page-link " v-on:click="next">Next</li>
            </ul>
        </nav>

        <div class="active_li">qweqweqweqwe</div>

    </div>
</template>
<script>

    import {postName} from "../../app.js";
    export default {

        data(){

            return {
                //главный массив постов
                posts: [],
                //массив в который положится промежуточное значение постов
                removed:[],
                //текущий номер страницы пагинации
                pagination_numb:0,
                //количество постов всего ( для пагинации )
                posts_length:0,
                //массив пагинации
                pagination:[],
                //активная страница
                active_page:0

            }
        },
        mounted() {

          //  console.log('qweQQQ ');
            this.render_table(this.posts, this.removed, this.pagination_numb, this.posts_length);


        },
        methods: {

            render_table(inp, removed, pagination_numb)
            {
                this.pagination=[];
                //множитель количества постов на странице ( он же номер )
                pagination_numb=pagination_numb*10;
                axios
                    .post('/api/render_posts',{
                        parent:this.current_line,
                    }).then(({ data }) => (
                    //запишем количество постов
                    this.posts_length=data.length,
                        this.count_pages(this.posts_length),
                        //пагинация с какой позиции и сколько взять
                            removed= data.splice(pagination_numb, 10),


                                removed.forEach(function(entry) {
                                inp.push({
                                    text:entry.name_post,
                                    id_post:entry.id_post,
                                });

                        })

                    )

                );
                //проверка на начало и конец списка

            },

            //не использую
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
               // this.select_line(numb);
               this.select_name(numb);
                //меняю значение поста
                this.$store.dispatch('setPostCounter', numb);
                //имя поста
                Vue.router.push({name:'add_procedures'});
            },
            delete_post(numb)
            {
                console.log(this.posts_length);
            },
            next()
            {
                if(((this.pagination_numb+1) * 10)<(this.posts_length))
                {
                    this.posts=[];
                    this.pagination_numb++;
                    this.render_table(this.posts, this.removed, this.pagination_numb);
                }

            },
            prev()
            {
                if(this.pagination_numb != 0)
                {
                    this.posts=[];
                    this.pagination_numb--;
                    this.render_table(this.posts, this.removed, this.pagination_numb);
                }

            },
            numb_pagination(page)
            {
                this.posts=[];
                this.pagination_numb=page;
                this.render_table(this.posts, this.removed, this.pagination_numb);
            },
            count_pages(numb)
            {
                for (let i = 1; i <= Math.ceil(numb/10); i++) {
                   this.pagination.push(i);
                }
            }


        },

    }
</script>
