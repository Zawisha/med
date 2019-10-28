<template>
    <div>
        <body class="body-2">
        <div class="section-4">
            <div class="div-screen-vost">
                <h1 class="h1">Восстановление доступа</h1>
                <div class="text-block-13">Укажите почтовый ящик на который зарегистрирован аккаунт</div>
                <div class="w-form">
                    <form id="email-form" name="email-form" data-name="Email Form" class="form-2" @submit.prevent="send">
                        <input type="email" class="text-field-vost1 w-input" maxlength="256" name="email" data-name="Email" placeholder="Ваш email" id="email" required=""/>
                        <div class="w-form-formrecaptcha recaptcha g-recaptcha g-recaptcha-error g-recaptcha-disabled g-recaptcha-invalid-key"></div>
                        <input type="submit" value="Восстановить доступ" data-wait="Ожидайте" class="button-3 w-button"/>
                    </form>
                    <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                    <div class="w-form-fail">
                        <div>Oops! Something went wrong while submitting the form.</div>
                    </div>
                </div>
            </div>
        </div>
        </body>
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
