<template>
    <div class="container justify-content-center back_content">
        <div class="row" >
            <div class="col-12">
                <div class="col-12">Родительский блок>Процедура 1> Стоимость активов> Те же лица ... последний вопрос Стоимость активов> Те же лица ... последний вопросСтоимость активов> Те же лица ... последний вопросСтоимость активов> Те же лица ... последний вопрос</div>

                <div class="header_content_text col-10 ml-auto">Название блока для системы</div>
                <div class="col-12 d-flex">
                   <div class="col-2 name_text"><b>Название:</b></div>
                    <textarea-autosize class="form-control col-10  " v-bind:class="{border_alert: hasItem('Название блока не может быть пустым')}" rows="1" id="block_name" name="text_block_name" v-model="text_block_name"> </textarea-autosize>
                </div>
                <div class="header_content_text col-10 ml-auto">Описание вопроса</div>
                <div class="col-12 d-flex">
                <div class="col-2 name_text"><b>Вопрос:</b></div>
                <textarea-autosize class="form-control" rows="3" id="messages" name="text"  v-model="question" v-bind:class="{border_alert: hasItem('Поле вопроса не может быть пустым')}" ></textarea-autosize>
                </div>

                <hr align="center" width="90%" size="10" color="#dddddd" />
                <div class="container">
                    <div class="row col-12">
                        <div class="col-2 name_text"><b>Ответы:</b></div>

                     <div class="prokrutka col-8 d-flex" v-bind:class="{border_alert: danger_ans}" >
                        <div v-for="(item,i) in answers"  class="border_content " >
                                <div>{{ i+1 }} вариант  <a href="#"  v-on:click.prevent="delete_answer(i)"> Удалить</a></div>
                                <textarea class="answer" rows="2" id="myTextarea" name="text" v-bind:class="{border_alert: hasItem('Поле ответа не может быть пустым.Проблема в блоке ' + (i+1))}" >{{ item.text }} </textarea>
                                    <div>
                                Направляет на блок:
                                    <a href="#" v-if="item.link_id ==0" v-on:click.prevent="modal_answer(i)" >Выбрать блок</a>
                                    <a href="#" v-if="item.link_id !=0" v-on:click.prevent="modal_answer(i)"> {{ item.link_name }} Изменить</a>
                                    </div>
                        </div>
                     </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-secondary active" v-on:click="add_answer">Добавить ответ</button>
                        </div>
                    </div>
                </div>
                <hr align="center" width="90%" size="10" color="#dddddd" />
                <modal v-if="showModal" @close="close_modal">
                    <h3 slot="link">custom</h3>
                </modal>


<!--                <div class="container">-->
<!--                    <div class="row col-12">-->

                    <div v-for="(item_parent, numb) in parents_array">
                        <div class="col-12 d-flex parents_up_block">
                            <div class="name_parent_text col-2"><b>Родитель {{ numb+1 }}:</b></div>
                      <div class="col-4" >
                          <a href="#" v-on:click.prevent="modal_answer(i)">{{ item_parent[0].parent_block_name }}</a>
                      </div>
                            <div class="col-6">
                        Описание вопроса родителя:
                        <textarea class="form-control parent_question" rows="2" name="text_block_parent_name"  v-bind:class="{border_alert: parents_hasItem('Поле вопроса родителя не может быть пустым.Проблема в родителе ' + (numb+1))}" > {{ item_parent[0].parent_question }}</textarea>
                            </div>
                         </div>

                        <div class=" col-12 d-flex">
                        <div class="name_text col-2"><b>Ответы родителя:</b></div>
                            <div class="prokrutka col-8 d-flex" v-bind:class="{border_alert: parents_numberHasItem('родитель ' + (numb))}">
                                <div v-for="(item, number) in item_parent" class="border_content " >
                                    <div>{{ number+1 }} вариант  <a href="#"  v-on:click.prevent="delete_answer(i)"> Удалить</a></div>
                                    <textarea class="answers_parent" rows="2"  name="text_block_name" v-bind:class="{border_alert: parents_hasItem('Поле ответа родителя не может быть пустым.Проблема в родителе ' + (numb+1) + ' Блок ' + (number+1))}" >{{ item.parent_answer_text }} </textarea>
                                    <div>
                                        Направляет на блок:
                                        <a href="#" v-if="item.parent_answer_link_id ==0" v-on:click.prevent="parents_modal_answer(item.parent_id_block, number, numb)" >Выбрать блок</a>
                                        <a href="#" v-if="item.parent_answer_link_id !=0" v-on:click.prevent="parents_modal_answer(item.parent_id_block, number, numb)"> {{ item.parent_answer_link_name }} Изменить</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                        <button type="button" class="btn btn-secondary active" v-on:click="parent_add_answer(
                        numb,
                        item_parent[0].parent_block_name,
                        item_parent[0].parent_id_block,
                        item_parent[0].parent_question,
                        )">Добавить ответ</button>
                            </div>
                        </div>
                        <hr align="center" width="90%" size="5" color="#fff" />
                    </div>

                <div v-for="(item) in danger_message"  class="border_content " >
                <div class="alert alert-danger" role="alert">
                   {{ item }}
                </div>
                </div>
                <div v-for="(item) in danger_parents_arr"  class="border_content " >
                    <div class="alert alert-danger" role="alert">
                        {{ item }}
                    </div>
                </div>
                <div class="alert alert-success" role="alert" v-if="success_message">
                    Изменения успешно сохранены!
                </div>

                <button type="button" class="btn btn-secondary active btn-block" v-on:click="save">Сохранить</button>
                <button type="button" class="btn btn-danger btn-block" v-on:click="test">Test</button>

                <parents_modal v-if="parents_showModal" @parents_close="parents_close_modal" :block=parents_current_block_string[0] :string_par=parents_current_block_string[1]>
                    <h3 slot="link">custom</h3>
                </parents_modal>
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
                parents_modal_column:'',
                d_flex_counter:0,
                danger_message:[],
                danger_ans:false,
                danger_parents_arr:[],
                danger_number_parent_arr:[],
                success_message:false
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

            hasItem(item)
            {
                return this.danger_message.indexOf(item) === -1 ? false : true
            },

            parents_hasItem(item)
            {
                return this.danger_parents_arr.indexOf(item) === -1 ? false : true
            },
            parents_numberHasItem(item)
            {
                return this.danger_number_parent_arr.indexOf(item) === -1 ? false : true
            },

            test()
            {


            } ,


            render_path()
            {
                axios
                    .post('/api/render_path',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:this.$store.state.block_id,
                    });
            },

            parents_delete_answer(first_number_of_array, second_number_of_array)
            {
                this.parents_array[first_number_of_array].splice(second_number_of_array,1);
            },

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
                    text:'',
                    link_id:0,
                                 });
            },


            validation()
            {
                this.success_message=false;
                this.danger_message=[];
                //nazvanie tekushego bloka
                if( this.text_block_name=='')
                {
                    this.danger_message.push('Название блока не может быть пустым');
                }

                //tekushii vopros
                if( this.question=='')
                {
                    this.danger_message.push('Поле вопроса не может быть пустым');
                }


                // otvety glavnogo bloka
                var elems = document.getElementsByClassName('answer');
                this.danger_ans_array=[];
                this.danger_ans = false;
                console.log(elems.length);
                for (let i = 0; i < elems.length; i++) {
                    if(elems[i].value==''||elems[i].value==' ')
                    {
                        this.danger_ans = true;
                        this.danger_message.push('Поле ответа не может быть пустым.Проблема в блоке ' + (i+1));
                    }

                }



                //voprosy roditelei
                let parent_question = document.getElementsByClassName('parent_question');
                this.danger_parents_arr =[];
                this.danger_number_parent_arr=[];
                for (let i = 0; i < parent_question.length; i++) {
                    if(parent_question[i].value=='')
                    {
                        this.danger_parents_arr.push('Поле вопроса родителя не может быть пустым.Проблема в родителе ' + (i+1));
                    }
                }

                //otvety roditelei
                let parents_ans = document.getElementsByClassName('answers_parent');
                let m = 0;
                for (let j = 0; j < this.parents_array.length; j++) {
                    for(let k = 0; k <this.parents_array[j].length; k++)
                    {
                        if(parents_ans[m].value==''||parents_ans[m].value==' ')
                        {
                            this.danger_parents_arr.push('Поле ответа родителя не может быть пустым.Проблема в родителе ' + (j+1) + ' Блок ' + (k+1));
                            this.danger_number_parent_arr.push('родитель ' + (j));
                        }
                        m++;
                    }
                }
                if((this.danger_message.length!==0)||(this.danger_parents_arr.length!==0))
                {
                    return 'error';
                }
                else
                {
                    return 'not error';
                }

            },

            save()
            {
                let valid = this.validation();
                if(valid == 'not error')
                {
                    this.answer=[];

                    let blocks_array_to_delete =[];
                    blocks_array_to_delete.push(this.$store.state.block_id);
                    for (let i = 0; i < this.parents_array.length; i++) {
                        blocks_array_to_delete.push(this.parents_array[i][0]['parent_id_block']);
                    }

                    axios
                        .post('/api/delete',{
                            id_post:this.$store.state.post_id,
                            id_procedure:this.$store.state.current_main_procedure,
                            id_block:blocks_array_to_delete,
                        }).then(({ data }) =>{
                            this.save_data()

                        }
                    );
                    this.success_message=true;
                }


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

            parent_add_answer(numb, name, id,question)
            {
                this.parents_array[numb].push({
                    parent_answer_link_id:0,
                    parent_answer_link_name:"",
                    parent_answer_text: "",
                    parent_block_name:name,
                    parent_id_block:id,
                    parent_question:question
                });
            }


        }

    }
</script>

