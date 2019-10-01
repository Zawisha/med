<template>
    <div class="container">
        <div class="row" >
            <div class="col-12 streak">
            </div>
        </div>
        <div class="row" >
        <div class="col-2"></div>
             <div class="content_exp_test col-8">


            <div class="col-12 d-flex header_exp_test ">
               <div class="col-4 col-md-2 "> <a href="/" ><img :src="'/img/logo.png'"  class="header_img" alt="logo" ></a></div>
                <div class="col-4 col-md-6 text-center exp_header_text" v-on:click="go_to_expertise()">Экспертиза</div>
                <div v-if="$auth.check()" class="col-4 col-md-6 text-center exp_header_text_us"><a href="#" @click.prevent="$auth.logout()">Logout</a></div>
                <div v-else class="col-4 col-md-6 text-center exp_header_text_us"><router-link :to="{ name: 'login' }">Вход в сервис</router-link></div>
            </div>

            <div class="col-12 front_text_procedure">
                <h1 class="h4">{{ test_front_text_procedure }}
            </h1></div>

            <div class="col-12">
                <div class="col-12 d-flex">
               <div class="front_answers_little col-8">Ответьте на следующие вопросы </div>
                <div class="col-4" v-on:click="refresh_expertise()"><button type="button" class="btn btn-secondary ">Пройти экспертизу заново</button></div>
                </div>
                    <div v-for="(post, number) in blocks" class="col-12 front_content_block">
                        <div class="col-12">{{ post.question_text }}</div>
                        <div class="col-12 d-flex">
                        <div v-for="(question, numb) in post.answer_text" class="front_button_right">
                            <div  class="col-12 myButton" v-bind:id="number + 'q' + numb" v-if="post.answer_link_id[numb] !==0" v-on:click="front_render_add_block(blocks,post.answer_link_id[numb],number,number + 'q' + numb)"
                            >{{ question }}</div>
                        </div>
                        </div>
                        <div class="col-12 bottom_streak"></div>
                    </div>

             </div>
<!--        <button type="button" class="btn btn-primary btn-block" v-on:click="test">test</button>-->

            </div>
        <div class="col-2">
        </div>
        </div>
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
            }
        },
        props:['front_procedure_id', 'front_text_procedure'],
        mounted() {
            this.render_start_block(this.blocks);
        },
        methods: {

            test()
            {
               console.log(this.blocks);
            },

            //

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
                let elem = document.getElementById(number_clicked_button);

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
