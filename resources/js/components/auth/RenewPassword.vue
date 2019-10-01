<template>
    <div>

        <div class="alert alert-danger" v-if="conf_password_alert">
            <p>Пароли не совпадают</p>
        </div>
        <div class="alert alert-danger" v-if="error_6">
            <p>Пароль не короче 6 символовqqqq</p>
        </div>
        <div class="alert alert-danger" v-if="success">
            <p>Пароль обновлён</p>
        </div>

        <form autocomplete="off" @submit.prevent="up_password" v-if="!success" method="post">
            <div class="form-group" >
                <label for="password">Пароль</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <div class="form-group" >
                <label for="conf_password">Повторите пароль</label>
                <input type="password" id="conf_password" class="form-control" v-model="conf_password" required>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                password: '',
                conf_password:'',
                conf_password_alert:false,
                success: false,
                error_6: false,
            };
        },
        methods: {
            up_password() {
                this.conf_password_alert=false;
                if (this.password !== this.conf_password) {
                    this.conf_password_alert=true;
                } else
                {
                    this.error_6 = false;
                    //PROVERKA PO BD
                        axios
                            .post('/ifexist',{
                                id: this.$route.params.id,
                                token:this.$route.params.token,
                                password: this.password
                            })
                            .then( (response)  => {
                                this.$router.push('/login')
                            })
                            .catch(error => {
                                this.error_6 = true;
                            })
                }
            }
        }
    }
</script>
