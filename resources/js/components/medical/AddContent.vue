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
        <button type="button" class="btn btn-primary btn-sm" v-on:click="forward">Вперёд</button>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                inputs: [],
                message: '' ,
                current_line: 0,
                marker:0,

            }
        },
        mounted() {


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
