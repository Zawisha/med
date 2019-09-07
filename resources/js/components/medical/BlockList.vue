<template>
    <div class="container">
        Список блоков:
        <div class="row justify-content-center">
            <div class="col-md-8">

<div v-for="item in inputs">
    <p class=" bg-success text-white rounded mybtn" style="white-space: pre-line" v-on:click="go_to_post(item.id_block)">
      {{ item.block_name }} => {{ item.id_block }}
    </p>
</div>
                <button type="button" class="btn btn-primary btn-block" v-on:click="new_block">Новый блок</button>
            </div>
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

                this.$store.dispatch('setBlockCounter', this.inputs.length+1),
                Vue.router.push({name:'add_content'});
            },


            go_to_post(numb)
            {

                this.$store.dispatch('setBlockCounter', numb),
                Vue.router.push({name:'add_content'});

            },

            render_start_array(inp)
            {
                axios
                    .post('/api/render_blocks',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                    }).then(({ data }) => (
                data.forEach(function(entry) {
                    inp.push({
                        id_block:entry.id_block,
                        block_name:entry.block_name,
                    });
                })
                    )
                );
            },



                     }

    }
</script>
