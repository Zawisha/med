<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{ text }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

                text: '',
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        created() {
            //console.log(this.$route.params.token);
            this.acceptUserToken();

        },
        methods: {
            acceptUserToken()
            {
                axios
                    .post('/api/confirm',{
                        tok: this.$route.params.token})
                    .then( (response)  => {
                        this.text=response.data.status;
                    });
            },


        }
    }
</script>
