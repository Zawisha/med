<template>


    <div>
        <body class="body-2">
        <div class="section">
            <div class="div-screen-1"><div class="div-block-8"><h1 class="heading">Экспертиза сделки</h1>
                <p class="paragraph exp vopros">Выбрана экономическая концентрация:</p>
                <div class="div-block-9"><div class="text-block-2">{{ test_front_text_procedure }}</div></div>
                <div class="div-block-10"><div class="text-block-3">Ответьте на следующие вопросы</div>

                    <div class="columns-2 w-row" v-for="(post, number) in blocks" >
                        <div class="column-6 w-col w-col-1 w-col-small-1 w-col-tiny-1">
                        <div class="div-block-14" v-if="number != (blocks.length-1)">
             <img src="https://uploads-ssl.webflow.com/5d93c99b337fd39ab87ef61a/5d9a604c574a7da7ff2a659e_checked-symbol.png" alt="" class="image-3"/>
                        </div>
                    </div>
                        <div class="column-5 w-col w-col-11 w-col-small-11 w-col-tiny-11"><div class="div-block-13">
                        <div class="text-block-4">{{ post.question_text }}</div>
                        <div class="div-block-11"  >
                        <div  class="button-5 yes exp_but_5" v-for="(question, numb) in post.answer_text"
                            v-bind:id="number + 'q' + numb" v-if="(post.answer_link_id[numb] !==0)" v-on:click="front_render_add_block(blocks,post.answer_link_id[numb],number,number + 'q' + numb)"
                        >{{ question }}</div>
                    </div>
                            <div class="div-block-11 final"
                                v-if="(post.answer_text ==((''))||(
                        post.answer_link_id.every(isNullElem)
                        )) ">
                                <div  class="button-5 yes new w-button" v-on:click="refresh_expertise()" >Начать сначала</div>
                                <router-link  :to="{ name: 'expertise' }"><div class="button-5 yes new w-button">Новая экспертиза</div></router-link>
                            </div>
<div></div>

                        <div class="div-block-12" v-if="number != (blocks.length-1)">
                        <div class="text-block-5"  >Выбран ответ: {{ answer_choose_arr[number]}}</div>
                        </div>

                        </div></div>
                    </div>


<!--                    <div class="columns-2 w-row"><div class="column-6 w-col w-col-1 w-col-small-1 w-col-tiny-1"><div class="div-block-14">-->
<!--                        <img src="https://uploads-ssl.webflow.com/5d93c99b337fd39ab87ef61a/5d9a604c574a7da7ff2a659e_checked-symbol.png" alt="" class="image-3"/></div></div>-->
<!--                        <div class="column-5 w-col w-col-11 w-col-small-11 w-col-tiny-11"><div class="div-block-13 final">-->
<!--                            <div class="text-block-4">Вам НЕ НУЖНО получать предварительное согласие МАРТ, но необходимо письменно уведомить МАРТ после проведения реорганизации.</div><div class="div-block-11 final">-->
<!--                            <a href="#" class="button-5 yes new w-button">Начать сначала</a>-->
<!--                            <a href="/page" class="button-5 yes new w-button">Новая экспертиза</a></div></div></div></div>-->
                </div>

<!--                <div class="columns-2 w-row"><div class="column-6 w-col w-col-1 w-col-small-1 w-col-tiny-1"><div class="div-block-14">-->
<!--                    <img src="https://uploads-ssl.webflow.com/5d93c99b337fd39ab87ef61a/5d9a604c574a7da7ff2a659e_checked-symbol.png" alt="" class="image-3"/></div></div><div class="column-5 w-col w-col-11 w-col-small-11 w-col-tiny-11"><div class="div-block-13">-->
<!--                    <div class="text-block-4">Блок с кнопкой как выглядит кнопка, когда пользователь выбрал ответ. Ответ выбран &quot;да&quot;</div>-->
<!--                    <div class="div-block-11"><a href="#" class="button-5 yes passive w-button">Да</a><a href="#" class="button-5 yes passive noactive w-button">Нет</a></div>-->
<!--                    <div class="div-block-12"><div class="text-block-5">Выбран ответ: Да</div></div></div></div>-->

<!--                -->
<!--                </div>-->


                </div></div>

        </div>
        </body>
    </div>


</template>

<script>

    export default {

        data(){

            return {
                //главный массив блоков
                blocks: [],
//current number of id block
                id_procedure:0,
                test_front_text_procedure:this.front_text_procedure,
                answer_choose_arr:[]
            }
        },
        props:['front_procedure_id', 'front_text_procedure'],
        mounted() {
            this.render_start_block(this.blocks);
        },
        methods: {

            isNullElem(number)
            {
                return number == 0;
            },

            go_to_expertise()
            {
                Vue.router.push({name:'expertise'});
            },

            refresh_expertise()
            {
                this.blocks=[];
                this.render_start_block(this.blocks);
            },

            render_start_block(inp)
            {

                axios
                    .post('/front_render_start_block',{
                        id_procedure:this.front_procedure_id,
                    }).then(({ data }) => (
                        inp.push({
                            id_post:data.id_post,
                            id_procedure:data.id_procedure,
                            id_block:data.id_block,
                            block_name:data.block_name,
                            question_text:data.question_text,
                            answer_text:data.answer_text,
                            answer_link_id:data.answer_link_id,
                        })
                    )
                );
            },

            front_render_add_block(inp, id_block, number_in_array, number_clicked_button)
            {
                // this.answer_choose_arr[number_in_array]
                let elem = document.getElementById(number_clicked_button);
                this.answer_choose_arr[number_in_array]=elem.innerHTML;

// console.log(number_clicked_button);
                let a = elem.id.split('q')[0];
                let elems = document.getElementsByClassName('myButton');
                for (let i=0; i<elems.length; i++) {
                    if(a == elems[i].id.split('q')[0]) {
                        $(elems[i]).removeClass( "red" );
                    }
                }
                $( elem).addClass( "red" );

                this.id_procedure=this.blocks[0]['id_procedure'];
                if(number_in_array !==(inp.length-1))
                {
                    inp.splice(number_in_array+1);
                }
                axios
                    .post('/front_render_add_block',{
                        id_procedure:this.id_procedure,
                        id_block:id_block
                    })
                    .then(({ data }) => (
                        inp.push({
                            id_post:data.id_post,
                            id_procedure:data.id_procedure,
                            id_block:data.id_block,
                            block_name:data.block_name,
                            question_text:data.question_text,
                            answer_text:data.answer_text,
                            answer_link_id:data.answer_link_id
                        })
                    )

                );
            },

        },

    }
</script>
