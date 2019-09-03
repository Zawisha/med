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

    <div v-for="item in answers">
    <p>
    1 вариант
    <textarea class="qwe" rows="2" id="myTextarea" name="text" >{{ item.text }} </textarea>
    Направляет на блок: XXXXXXXXX
    </p>
    </div>
                <button type="button" class="btn btn-secondary active" v-on:click="add_answer">Добавить ответ</button>

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
                <button type="button" class="btn btn-danger btn-block">На главную</button>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                // current_line: 0,
                // marker:0,
                answers: [],
                message: '' ,
                text_block_name:'',
                question:'',
                parents:false
            }
        },
        mounted() {

            //current main_procedure
            this.render_start_array(this.inputs);


        },
        created(){
        },
        methods: {

            add_answer()
            {
                this.answers.push({
                    text: "",
            });

            },

            save()
            {
            this.answer=[];

            //получил ответы
               var elems = document.getElementsByClassName('qwe');[0].value;
                var i;
                for (i = 0; i < elems.length; i++) {

                    axios
                        .post('/api/add_content',{
                            id_post:this.$store.state.post_id,
                            id_procedure:this.$store.state.current_main_procedure,

                            number_line:this.$store.state.lineCounter,
                            parent:this.current_line,
                            text:this.message
                        });

                  console.log(elems[i].value);
                }

            },

            add_new_line()
            {
                //vuex увеличение счётчика линии
                this.$store.dispatch('upLineCounter');

                this.inputs.push({
                    text:this.message,
                    numb_line:this.$store.state.lineCounter,
                });
                axios
                    .post('/api/add_content',{
                            id_post:this.$store.state.post_id,
                            name_post:this.$store.state.totalTvCount,
                            number_line:this.$store.state.lineCounter,
                            parent:this.current_line,
                            text:this.message
                    });
                this.message ='';

            },

            next_post(numb)
            {
                    this.current_line = numb;
                    this.inputs = [];
                //навигация совпала
                if(this.current_line == this.$store.state.navigation[this.marker+1])
                {

                this.marker++;
                }
                //навигация не совпала
                else
                {
                    this.marker++;
                    //если в массиве только ноль
                        this.$store.dispatch('spliceElem',this.marker);
                        this.$store.dispatch('change_nav', this.current_line);
                }


                this.render_start_array(this.inputs);
                //запишем новое значение навигации в массив
                console.log('current_line ->' + this.current_line);
                console.log('marker ->' + this.marker);
                console.log(this.$store.state.navigation);


            },
            back()
            {
                if(this.current_line != 0) {
                    this.inputs = [];
                    this.message = '';
                    this.marker--;
                    this.current_line=(this.$store.state.navigation[this.marker]);
                    console.log('current_line after back ->' + this.current_line);
                    console.log('marker ->' + this.marker);
                    console.log(this.$store.state.navigation);
                    this.render_start_array(this.inputs);
                }



            },
            forward()
            {
                if((this.marker+1)!=(this.$store.state.navigation.length))
                {
                    this.inputs = [];
                    this.marker++;
                    console.log('current_line after forward ->' + this.current_line);
                    this.current_line=(this.$store.state.navigation[this.marker]);
                    this.render_start_array(this.inputs);
                }

            },

            render_start_array(inp)
            {
                axios
                    .post('/api/render',{
                        parent:this.current_line,
                        post_in_work:this.$store.state.post_id,
                    }).then(({ data }) => (
                data.forEach(function(entry) {
                    inp.push({
                        text:entry.text,
                        numb_line:entry.number_line,
                    });
                })
                    )
                );
            },



        }

    }
</script>
