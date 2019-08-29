<template>
    <div class="col">
                <h1 style="color:green">Введите назание поста</h1>
                <p>Название: {{ message }}</p>
                <form @submit.prevent="push_the_button">
                    <div class="form-group">
                        <textarea class="form-control" rows="6" id="messages" name="text" v-model="message">
              </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
        methods: {

            push_the_button()
            {
                axios
                    .post('/api/post_id').then(({ data }) => (
                    this.$store.dispatch('spliceElem',1),
                    this.$store.dispatch('setLineCounter', 0),
                    this.$store.dispatch('setPostCounter', data+1),
                    this.$store.dispatch('changeName', this.message),
                    Vue.router.push({name:'add_content'})
                    )
                );


            },


        },

    }
</script>
