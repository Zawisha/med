<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

<div v-for="item in inputs">
    <p class=" bg-success text-white rounded mybtn" style="white-space: pre-line" v-on:click="next_post(item.numb_line)">
      {{ item.text }} => {{ item.numb_line }}
    </p>
</div>

                <textarea class="form-control" rows="2" id="messages" name="text"  v-model="message"> </textarea>
                <button type="button" class="btn btn-primary btn-block" v-on:click="add_new_line">Сохранить строку и добавить новую</button>
                <button type="button" class="btn btn-danger btn-block">Полностью сохранить блок</button>
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-sm" v-on:click="back" >Назад</button>
        <button type="button" class="btn btn-primary btn-sm">Вперёд</button>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                inputs: [],
                message: '' ,
                current_line: 0,

            }
        },
        mounted() {
//            console.log(this.$store.state.totalTvCount);

            this.render_start_array(this.inputs);


        },
        created(){
        },
        methods: {

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
                            id_post:'1',
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
                this.render_start_array(this.inputs);
//запишем новое значение навигации в массив
                this.$store.dispatch('change_nav', this.current_line);
                console.log(this.$store.state.navigation)
            },
            back()
            {
                if(this.current_line != 0) {
                    this.inputs = [];
                    this.message = '';
                    //выберем предыдущий номер массива( строки )
                    for (var i = 0; i < this.$store.state.navigation.length; i++) {
                        if (this.$store.state.navigation[i] == this.current_line) {
                            this.current_line=(this.$store.state.navigation[i - 1]);
                        }
                    }

                };
                this.render_start_array(this.inputs);


            },

            render_start_array(inp)
            {
                axios
                    .post('/api/render',{
                        parent:this.current_line,
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
