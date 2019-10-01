<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>Проверьте email</p>
        </div>
        <div class="alert alert-danger" v-if="done">
            <p>Вам выслано письмо для сброса пароля</p>
        </div>
        <div class="alert alert-danger" v-if="!done">
        Введите адрес почты
        <form autocomplete="off" @submit.prevent="send" method="post" >
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                email: null,
                error: false,
                done:false
            }
        },
        methods: {
            send()
            {
                axios
                    .post('/forget',{
                        email: this.email})
                    .then( (response)  => {
                        this.done = true;
                        this.error = false;
                    })
                    .catch(error => {
                        this.error = true;
                        }

                    );
            },


        }
    }
</script>
