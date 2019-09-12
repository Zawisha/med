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
    {{ i+1 }} вариант  <a href="#"  v-on:click.prevent="delete_answer(i)"> Удалить</a>
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


                    <div>Родители:</div>
                    <div v-for="(item_parent, numb) in parents_array">
                        Имя родителя
                        {{ item_parent[0].parent_block_name }}
                        Описание вопроса:
                        <textarea class="form-control parent_question" rows="2" name="text_block_parent_name" > {{ item_parent[0].parent_question }}</textarea>

                        <div v-for="(item, number) in item_parent">
                            <div>Ответы родителя:</div>
                            <p>
                                {{ number+1 }} вариант  <a href="#"  v-on:click.prevent="delete_answer(number)"> Удалить</a>
                                <textarea class="form-control answers_parent" rows="2" name="text_block_name" > {{ item.parent_answer_text }} </textarea>
                                Направляет на блок:
                                <a href="#" v-if="item.parent_answer_link_id ==0" v-on:click.prevent="parents_modal_answer(item.parent_id_block, number, numb)" >Выбрать блок</a>
                                <a href="#" v-if="item.parent_answer_link_id !=0" v-on:click.prevent="parents_modal_answer(item.parent_id_block, number, numb)"> {{ item.parent_answer_link_name }} Изменить</a>
                            </p>

                        </div>
                        <button type="button" class="btn btn-secondary active" v-on:click="parent_add_answer(numb)">Добавить ответ</button>
                    </div>
                <hr align="center" width="90%" size="5" color="#fff" />

                <parents_modal v-if="parents_showModal" @parents_close="parents_close_modal" :block=parents_current_block_string[0] :string_par=parents_current_block_string[1]>
                    <h3 slot="link">custom</h3>
                </parents_modal>


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
                showModal:false,
                //номер в массиве выбранного ответа
                answer_link_to_modal:'',
                parents_array:[],
                parents_showModal:false,
                parents_current_block_string:[],
                parents_modal_column:''
            }
        },
        mounted() {

            //current main_procedure
            this.render_start_array(this.answers);
            this.render_start_parents_array(this.parents_array);

        },
        created(){
        },
        methods: {

            test()
            {
                console.log(this.parents_array);
            } ,

            delete_answer(numb)
            {
                this.answers.splice(numb,1);
            },

            parents_close_modal(data)
            {
                this.parents_showModal = false;

                if(data) {
                    this.parents_array[this.parents_modal_column][this.parents_current_block_string[1]]['parent_answer_link_id'] = data['id_block_modal'],
                    this.parents_array[this.parents_modal_column][this.parents_current_block_string[1]]['parent_answer_link_name'] = data['block_name_modal']
                }
                this.parents_current_block_string=[];
                this.parents_modal_column='';

            },

            close_modal(data)
            {

                this.showModal = false;
                    if(data){
                            this.answers[this.answer_link_to_modal]['link_id'] = data['id_block_modal'],
                            this.answers[this.answer_link_to_modal]['link_name'] = data['block_name_modal']
                    }

            },

            modal_answer(numb)
            {
                this.showModal = true,
                this.answer_link_to_modal=numb
            },

            parents_modal_answer(id_parent_block,numb_of_string, numb_of_first_column)
            {
                this.parents_current_block_string[0]=id_parent_block,
                    this.parents_current_block_string[1]=numb_of_string,
                    this.parents_modal_column=numb_of_first_column,
                this.parents_showModal = true
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

            let blocks_array_to_delete =[];
                blocks_array_to_delete.push(this.$store.state.block_id);
                for (let i = 0; i < this.parents_array.length; i++) {
                    blocks_array_to_delete.push(this.parents_array[i][0]['parent_id_block']);
                }
            // console.log('block to delete' + blocks_array_to_delete);

                axios
                    .post('/api/delete',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:blocks_array_to_delete,
                    }).then(({ data }) =>{
                        this.save_data()

                }
                )

                //this.save_data();

            },

            save_data()
            {
                //получил ответы
                var elems = document.getElementsByClassName('answer');
                //формирую массив значений для отправки
                let  answer_arr=[];
                let  answer_link_arr=[];
                for (let i = 0; i < elems.length; i++) {
                    answer_arr.push(elems[i].value);
                    answer_link_arr.push(this.answers[i]['link_id']);
                }


               // работа с родителями
                let parent_answer_arr=[];
                let parents_ans = document.getElementsByClassName('answers_parent');
                let parent_question = document.getElementsByClassName('parent_question');
                let m =0;
                for (let i = 0; i < this.parents_array.length; i++) {
                    for(let j = 0; j <this.parents_array[i].length; j++)
                    {
                        parent_answer_arr.push({
                            parent_id_block:this.parents_array[i][0]['parent_id_block'],
                            parent_name_block:this.parents_array[i][0]['parent_block_name'],
                            parent_question_text:parent_question[i].value,
                            answer_link_id:this.parents_array[i][j]['parent_answer_link_id'],
                            answer:parents_ans[m].value
                        });
                        m++;
                    }
                    console.log( parent_answer_arr);
                    console.log('dlina' +this.parents_array[i].length);

               }
                //конец блока родителей

                     axios
                        .post('/api/add_content',{
                            id_post:this.$store.state.post_id,
                            id_procedure:this.$store.state.current_main_procedure,
                            id_block:this.$store.state.block_id,
                            block_name:this.text_block_name,
                            question_text:this.question,
                            answer_text:answer_arr,
                            answer_link_id:answer_link_arr,
                            parents:parent_answer_arr
                        });
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


            //parents block
            render_start_parents_array(inp)
            {
                axios
                    .post('/api/render_parents',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:this.$store.state.block_id,
                    }).then(({ data }) =>
                    {
                        if(data.length != 0)
                        {
                            for(let i = 0; i < data.length; i++) {
                                let temp_inp=[];
                                data[i].forEach(function (entry) {
                                    temp_inp.push({
                                        parent_id_block:entry.id_block,
                                        parent_block_name:entry.block_name,
                                        parent_question:entry.question_text,
                                        parent_answer_text:entry.answer_text,
                                        parent_answer_link_id:entry.answer_link_id,
                                        parent_answer_link_name:entry.answer_link_name
                                    })
                                })
                                    inp.push(temp_inp);
                            }

                        }

                    }

                );

            },

            parent_add_answer(numb)
            {
                this.parents_array[numb].push({
                    parent_answer_text: "",
                    parent_answer_link_id:0,
                });
            }


        }

    }
</script>

