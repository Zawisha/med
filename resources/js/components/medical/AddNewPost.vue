<template>
    <div class="col">
                <h1 style="color:green">Введите заголовок поста (например: Какую из форм экономической концентрации вы планируете совершить? ) </h1>
                <p>Заголовок поста: {{ message }}</p>
                <form @submit.prevent="push_the_button">
                    <div class="form-group">
                        <textarea class="form-control" rows="6" id="messages" name="text" v-model="message">
              </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
    </div>
</template>
<script>

    import {postName} from "../../app.js";
    export default {

        data(){

            return {
                message: '',

            }
        },
        mounted() {

            this.find_post_id();

        },
        methods: {


            find_post_id()
            {
                axios
                    .post('/api/post_id').then(({ data }) => (
                        //установим номер поста
                        this.$store.dispatch('setPostCounter', data+1)
                    )
                )
            },

            push_the_button()
            {
                //установим имя поста
                this.$store.dispatch('changeName', this.message),
//сохраним пустую процедуру
                    axios
                        .post('/api/add_procedure',{
                            id_post:this.$store.state.post_id,
                            name_post:this.$store.state.namePost,
                            id_main_procedure:0,
                            name_main_procedure:0
                        }).then( Vue.router.push({name:'add_procedures'}));




            },


        }

    }
</script>
