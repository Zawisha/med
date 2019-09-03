<template>
    <div class="container">
        Список процедур:
        <div class="row justify-content-center">
            <div class="col-md-8">

<div v-for="item in inputs">
    <p class=" bg-success text-white rounded mybtn" style="white-space: pre-line" v-on:click="go_to_post(item.id_main_procedure)">
      {{ item.name_main_procedure }} => {{ item.id_main_procedure }}
    </p>
</div>

                <textarea class="form-control" rows="2" id="messages" name="text"  v-model="message"> </textarea>
                <button type="button" class="btn btn-primary btn-block" v-on:click="add_new_line">Сохранить процедуру</button>
                <button type="button" class="btn btn-primary btn-block" v-on:click="test">test</button>
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

            test()
            {
                console.log('POST NUMBER '+this.$store.state.post_id);
            },

            add_new_line()
            {
                //установим счётчик процедуры
                this.procedure_number = this.inputs.length;
                this.procedure_number++;
                this.inputs.push({
                    name_main_procedure:this.message,
                    id_main_procedure:this.procedure_number,
                });

                axios
                    .post('/api/add_procedure',{
                            id_post:this.$store.state.post_id,
                            name_post:this.$store.state.namePost,
                            id_main_procedure:this.procedure_number,
                            name_main_procedure:this.message
                    });
                this.message ='';

            },

            go_to_post(numb)
            {
                this.$store.dispatch('setCurrentMainProcedure', numb),
                Vue.router.push({name:'block_list'});

            },


            render_start_array(inp)
            {
                axios
                    .post('/api/render_procedures',{
                        id_post:this.$store.state.post_id,
                    }).then(({ data }) => (
                data.forEach(function(entry) {
                    inp.push({
                        name_main_procedure:entry.name_main_procedure,
                        id_main_procedure:entry.id_main_procedure,
                    });
                })
                    )
                );
            },



        }

    }
</script>
