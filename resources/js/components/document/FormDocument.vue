<template>
<div>
    <div class="container w-container">
  Forming document
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
                    fileLink.href = 'text/Expertise.txt';

                    fileLink.setAttribute('download', 'Expertise.txt');

                    document.body.appendChild(fileLink);



                    fileLink.click();


            },


        },

    }
</script>
