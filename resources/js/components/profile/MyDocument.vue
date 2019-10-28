<template>

    <div>
        <body class="body-2">
            <div class="section">
                 <div class="div-screen-1">
                <div class="div-block-8">
                    <p class="paragraph exp">Список ваших документов</p>
                    <a class="button-5 w-button" v-for="(doc) in my_documents_array" v-on:click="">{{ doc.document_name  }}</a>

                </div>
             </div>
        </div>
        </body>
    </div>

</template>

<script>

    export default {

        data(){

            return {
                my_documents_array:[]

            }
        },
        mounted() {

           // this.post_name=this.posts[0]['name_post'];
        },
        methods: {
            render_star_arr(inp)
            {
                axios
                    .post('/render_documents',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:this.$store.state.block_id,
                    }).then(({ data }) =>
                    {
                        if(data.length != 0)
                        {
                            this.text_block_name = data[0].block_name,
                                this.question = data[0].question_text,

                                data.forEach(function(entry) {
                                    if(entry.answer_text!==''){
                                        inp.push({
                                            text:entry.answer_text,
                                            link_id:entry.answer_link_id,
                                            link_name:entry.answer_link_name,

                                        });
                                    }
                                })
                        }

                    }

                );
            },
            test()
            {
                // axios
                //     .post('/test',{
                //     })
            },




        },

    }
</script>

