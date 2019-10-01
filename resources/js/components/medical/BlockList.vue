<template>
    <div class="container">

        <div class="col">
            <div>Список блоков:</div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col-7">Название блока</th>
                    <th scope="col-1"></th>
                    <th scope="col-2"></th>
                    <th scope="col-2"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, number) in inputs">
                    <td scope="col-8">
                        {{ item.block_name }}
                    </td>
                    <td scope="col-1">
                        <input class="form-check-input" type="radio" name="PostRadios" id="ExId" :checked="item.id_block == current_front_block" value="1" v-on:click="change_front_current_block(item.id_block)">
                    </td>
                    <td scope="col-2"><button type="button" class="btn btn-secondary" v-on:click="go_to_post(item.id_block)">Редактировать</button></td>
                    <td scope="col-2"><button type="button" class="btn btn-danger" v-on:click="delete_block(item.id_block, number)">Удалить</button></td>
                </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-block" v-on:click="new_block">Новый блок</button>
        </div>
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
                inputs: [],
                message: '' ,
                current_line: 0,
                procedure_number:0,

                //массив в который положится промежуточное значение постов
                removed:[],
                //текущий номер страницы пагинации
                pagination_numb:0,
                //количество постов всего ( для пагинации )
                posts_length:0,

                current_front_block :0
            }
        },
        mounted() {


           this.render_start_array(this.inputs);
           this.select_front_current_block();
        },
        created(){
        },
        methods: {

            change_front_current_block(id_block)
            {
                axios
                    .post('/change_current_block',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:id_block
                    });
            },
            new_block()
            {
                axios
                    .post('/max_block_id',{
                    }).then(({ data }) =>{
                    this.$store.dispatch('setBlockCounter', data+1),
                        Vue.router.push({name:'add_content'});
                });
            },


            go_to_post(numb)
            {

                this.$store.dispatch('setBlockCounter', numb),
                Vue.router.push({name:'add_content'});

            },

            render_start_array(inp, removed, pagination_numb)
            {
                pagination_numb=pagination_numb*10;
                axios
                    .post('/render_blocks',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                    }).then(({ data }) => (
                        this.posts_length=data.length,
                        removed= data.splice(pagination_numb, 10),
                        removed.forEach(function(entry) {
                    inp.push({
                        id_block:entry.id_block,
                        block_name:entry.block_name,
                    });
                })
                    )
                );
            },

            next()
            {
                if(((this.pagination_numb+1) * 10)<(this.posts_length))
                {
                    this.inputs=[];
                    this.pagination_numb++;
                    this.render_start_array(this.inputs, this.removed, this.pagination_numb);
                }

            },
            prev()
            {
                if(this.pagination_numb != 0)
                {
                    this.inputs=[];
                    this.pagination_numb--;
                    this.render_start_array(this.inputs, this.removed, this.pagination_numb);
                }

            },

            delete_block(id_block, number_in_arr)
            {
                axios
                    .post('/delete_block',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:id_block,
                    });
                this.inputs.splice(number_in_arr,1)
            },

            select_front_current_block()
            {
                axios
                    .post('/select_front_current_block',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                    })
                    .then(({ data }) => (
                            this.current_front_block=data
                        )
                    );
            },

                     }

    }
</script>
