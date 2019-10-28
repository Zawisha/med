<template>
<div>
    <div class="container w-container">


        <div class="alert alert-success" role="alert" v-if="notification_sub">
            Субъект добавлен
        </div>

            <router-link  :to="{ name: 'prep_doc' }"><a  class="button-2 w-button">Добавить субъект</a></router-link>
            <router-link  :to="{ name: 'doc' }"><a  class="button-2 w-button">Сформировать документ</a></router-link>




<!--    <div>-->
<!--        <button type="button" class="btn btn-primary procedure_button" v-on:click="get_file" >Скачать документ</button>-->
<!--    </div>-->



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
        props:['notification_sub'],
        mounted() {

        },
        methods: {

            get_file()
            {

                   // var fileURL = window.URL.createObjectURL(new Blob(['text/Expertise']));

                    var fileLink = document.createElement('a');



                    // fileLink.href = fileURL;
                    fileLink.href = 'text/Expertise.txt';

                    fileLink.setAttribute('download', 'Expertise.txt');

                    document.body.appendChild(fileLink);



                    fileLink.click();


            },


        },

    }
</script>
