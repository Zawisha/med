<template>
<div>
    <div class="section">
        <div class="div-screen-1">
            <div class="div-block-8">
                <h1 class="heading">Подготовка документов для подачи в МАРТ</h1>
                <p class="paragraph exp">Какой документ вы хотите составить?</p>
                <a class="button-5 w-button" v-for="(doc) in documents_array" v-on:click="go_to_doc(doc.id_document)">{{ doc.document_name  }}</a>


            </div>
        </div>
    </div>


</div>


<!--    <div>-->
<!--        <button type="button" class="btn btn-primary btn-block procedure_button" v-on:click="test" >Сохранить</button>-->
<!--    </div>-->

</template>

<script>

    export default {

        data(){

            return {
                //главный массив постов
                documents_array: [],
            }
        },
        mounted() {
this.render_start_array(this.documents_array);
        },
        methods: {

            go_to_doc(numb)
            {
     Vue.router.push({name:'document' + numb});
            },

            test()
            {
                axios
                    .post('/save_first_text',{
                    })
            },

            render_start_array(inp)
            {
                axios
                    .post('/documents_list',{
                    }).then(({ data }) =>
                    {
                                data.forEach(function(entry) {
                                        inp.push({
                                            id_document:entry.id_document,
                                            document_name:entry.document_name
                                        });

                                })


                    }

                );
            },


        },

    }
</script>
