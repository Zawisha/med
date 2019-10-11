<template>
<div>
    <div class="container w-container">
    <div>Ваш документ готов.</div>
    <div>
        <button type="button" class="btn btn-primary procedure_button" v-on:click="get_file" >Скачать документ</button>
    </div>


    <div class="section-2">
        <div class="div-block-7">
            <div class="columns w-row">
                <div class="w-col w-col-6">
                    <div>
                        <div class="text-block">  © Все права защищены</div>
                    </div>
                </div>
                <div class="w-col w-col-6"></div>
            </div>
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
                posts: [],
                post_name:''
            }
        },
        mounted() {

        },
        methods: {

            get_file()
            {

                   // var fileURL = window.URL.createObjectURL(new Blob(['text/Expertise']));

                    var fileLink = document.createElement('a');



                    // fileLink.href = fileURL;
                    fileLink.href = 'text/Expertise.doc';

                    fileLink.setAttribute('download', 'Expertise.doc');

                    document.body.appendChild(fileLink);



                    fileLink.click();


            },


        },

    }
</script>
