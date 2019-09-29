<template>
    <div class="container">
        <div class="col">
            <li>
                <router-link :to="{ name: 'expertise' }">Пройти экспертизу</router-link>
            </li>
           <div>Вторая часть</div>
        </div>

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


            }
        },
        mounted() {


            this.render_start_array(this.inputs);

        },
        created(){
        },
        methods: {


            new_block()
            {
                axios
                    .post('/api/max_block_id',{
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
                    .post('/api/render_blocks',{
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
                    .post('/api/delete_block',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:id_block,
                    });
                this.inputs.splice(number_in_arr,1)
            },


        }

    }
</script>
