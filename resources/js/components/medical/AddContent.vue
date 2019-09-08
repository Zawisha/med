<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
Название:
                <textarea class="form-control" rows="1" id="block_name" name="text_block_name" v-model="text_block_name"> </textarea>
Вопрос:
                <textarea class="form-control" rows="2" id="messages" name="text"  v-model="question"></textarea>
                <hr align="center" width="90%" size="10" color="#dddddd" />
                <div>Ответы:</div>

    <div v-for="(item,i) in answers">
    <p>
    {{ i+1 }} вариант
    <textarea class="answer" rows="2" id="myTextarea" name="text" >{{ item.text }} </textarea>
    Направляет на блок:
        <a href="#" v-if="item.link_id ==0" v-on:click.prevent="modal_answer(i)" >Выбрать блок</a>



<!--        <a href="#" v-if="item.link_id !=0" >{{ item.link_name }}</a>-->
        <a href="#" v-if="item.link_id !=0" v-on:click.prevent="modal_answer(i)"> {{ item.link_name }} Изменить</a>
<!--        {{ item.link_id }}-->
    </p>
    </div>
                <button type="button" class="btn btn-secondary active" v-on:click="add_answer">Добавить ответ</button>

<!--                <button id="show-modal" @click="showModal = true" >Show Modal</button>-->
                <modal v-if="showModal" @close="close_modal">
                    <h3 slot="link">custom</h3>
                </modal>



                <hr align="center" width="90%" size="10" color="#dddddd" />
                <div v-if="parents">
                <hr align="center" width="90%" size="5" color="#dddddd" />
                <div>Родители:</div>
                Имя родителя
                Описание вопроса. Изменить
                <textarea class="form-control" rows="2" id="3" name="text"  v-model="message"> </textarea>
                Ответы родителя:
                1 вариант
                <textarea class="form-control" rows="2" id="4" name="text"  v-model="message"> </textarea>
                Направляет на блок: XXXXXXXXX
                2 вариант
                <textarea class="form-control" rows="2" id="5" name="text"  v-model="message"> </textarea>
                </div>
                <div v-else>Родителей нет.</div>

                <button type="button" class="btn btn-secondary active" v-on:click="save">Сохранить</button>
                <button type="button" class="btn btn-danger btn-block" v-on:click="test">Test</button>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                answers: [],
                message: '' ,
                text_block_name:'',
                question:'',
                parents:false,
                showModal:false,
                //номер в массиве выбранного ответа
                answer_link_to_modal:'',

            }
        },
        mounted() {

            //current main_procedure
            this.render_start_array(this.answers);


        },
        created(){
        },
        methods: {

            test()
            {
                console.log(this.answers);
            } ,

            close_modal(data)
            {

                this.showModal = false,
                this.answers[this.answer_link_to_modal]['link_id'] = data['id_block_modal'],
                this.answers[this.answer_link_to_modal]['link_name'] = data['block_name_modal']
            },

            modal_answer(numb)
            {
                this.showModal = true,
                this.answer_link_to_modal=numb
            },

            add_answer()
            {
                this.answers.push({
                    text: "",
                    link_id:0,
            });

            },

            save()
            {
            this.answer=[];

                axios
                    .post('/api/delete',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:this.$store.state.block_id,
                    }).then(({ data }) =>{
                        this.save_data()

                }
                )
            },

            save_data()
            {
                //получил ответы
                var elems = document.getElementsByClassName('answer');
                var i;
                for (i = 0; i < elems.length; i++) {

                    axios
                        .post('/api/add_content',{
                            id_post:this.$store.state.post_id,
                            id_procedure:this.$store.state.current_main_procedure,
                            id_block:this.$store.state.block_id,
                            block_name:this.text_block_name,
                            question_text:this.question,
                            answer_text:elems[i].value,
                            answer_link_id:this.answers[i]['link_id'],
                        });
                }


            },



            render_start_array(inp)
            {
                axios
                    .post('/api/render',{
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
                            inp.push({
                                text:entry.answer_text,
                                link_id:entry.answer_link_id,
                                link_name:entry.answer_link_name,

                            });
                        })
                    }

                }

                );
            },



        }

    }
</script>

