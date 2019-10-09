<template>
<div>
    <div class="section">
        <div class="div-screen-1">
            <div class="div-block-8">
                <h1 class="heading">Подготовка документов для подачи в МАРТ</h1>
                <p class="paragraph exp">Какой документ вы хотите составить?</p>
                <router-link  :to="{ name: 'prep_doc' }"><div class="button-5 post"><a  class="link-post w-inline-block">
                    <div class="text-block-7">Постановление МАРТ от 10.08.2018 №62 - уведомление</div>
                </a>
                    <a href="https://yadi.sk/i/EqBg0wf5HVheDQ" target="_blank" class="link-block w-inline-block">
                        <img src="https://uploads-ssl.webflow.com/5d93c99b337fd39ab87ef61a/5d9d0a74b01a536db15dac8c_document.svg" width="32" alt=""/></a>
                </div>
                </router-link>

            </div>
        </div>
    </div>
    <div class="section-2"><div class="div-block-7">
        <div class="columns w-row">
            <div class="w-col w-col-6"><div>
                <div class="text-block">  © Все права защищены</div>
            </div></div>
            <div class="w-col w-col-6"></div></div>
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

            test()
            {
                axios
                    .post('/save_first_text',{
                    })
            },


        },

    }
</script>
