<template>
    <div class="col">
<div>Общий список постов</div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col-7">Название поста</th>
                <th scope="col-1">Активен</th>
                <th scope="col-2"></th>
                <th scope="col-2"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post, number) in posts">
                <td scope="col-7">
                    {{ post.text }}
                </td>
                <td scope="col-1">
                    <input class="form-check-input" type="radio" name="PostRadios" id="ExId" :checked="post.id_post == current_front_post" value="1" v-on:click="change_front_current_post(post.id_post,post.text)">
                </td>
                <td scope="col-2"><button type="button" class="btn btn-secondary" v-on:click="edit_post(post.id_post)">Редактировать</button></td>
                <td scope="col-2"><button type="button" class="btn btn-danger" v-on:click="delete_post(post.id_post,number)">Удалить</button></td>
            </tr>

            </tbody>
        </table>
        <button type="button" class="btn btn-primary btn-block" v-on:click="test">test</button>

            <ul class="pagination">
                <li class="page-item page-link disabled my_pointer" v-on:click="prev">Previous</li>
                <li class="page-item page-link my_pointer" v-on:click="next">Next</li>
            </ul>


    </div>
</template>
<script>

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

                current_front_post :0

            }
        },
        mounted() {
            this.render_table(this.posts, this.removed, this.pagination_numb, this.posts_length);
            this.select_front_current_post();
        },
        methods: {

            test()
            {
              console.log(this.current_front_post);
            },

            render_table(inp, removed, pagination_numb)
            {
                //множитель количества постов на странице ( он же номер )
                pagination_numb=pagination_numb*10;
                axios
                    .post('/render_posts',{
                    }).then(({ data }) => (
                    //запишем количество постов
                        this.posts_length=data.length,
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
            },

            select_name(numb)
            {
                axios
                    .post('/select_name',{
                        id_post:numb,
                    })
                    .then(({ data }) => (
                       this.$store.dispatch('changeName', data.name_post)
                        )
                    );
            },

            change_front_current_post(id_post, name_post)
            {
                axios
                    .post('/add_current_post',{
                        id_post:id_post,
                        name_post:name_post
                    });
            },

            select_front_current_post()
            {
                axios
                    .post('/select_front_current_post',{
                    })
                    .then(({ data }) => (
                        this.current_front_post=data
                        )
                    );
            },

            edit_post(numb)
            {
                //выбираю номер линии у поста
               this.select_name(numb);
                //меняю значение поста
                this.$store.dispatch('setPostCounter', numb);
                //имя поста
                Vue.router.push({name:'add_procedures'});
            },
            delete_post(numb, numb_in_arr)
            {
                console.log('nomer posta' + numb);
                console.log('nomer stroki' + numb_in_arr);
                axios
                    .post('/delete_post',{
                        id_post:numb,
                    });
                this.posts.splice(numb_in_arr,1)
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

        },

    }
</script>
