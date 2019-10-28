<template>
    <div>
        <div class="div-screen-1">
            <div class="_2-columns-home-page w-row"><div class="text-column w-col w-col-7">
                <div class="div-block-8">
                    <h1 class="heading">Помощник для бизнеса<br/>по вопросам согласования<br/>документов с МАРТ</h1>
                    <p class="paragraph">Пройдите экспертизу сделки. <br/>Подготовьте документы.<br/>Получите документ о согласии сделки.</p>
                </div></div>
                <div class="image-column w-col w-col-5"><div class="image-bg_01">
                    <img src="https://uploads-ssl.webflow.com/5d93c99b337fd39ab87ef61a/5d97b354e9082900146f59a2_bg_01.jpg" alt="" class="image-2"/>
                </div></div></div>

            <div class="columns-service w-row"><div class="column-expert w-col w-col-6 w-col-small-small-stack"><div class="div-block-expert"><h3 class="heading-2">Экспертиза планируемой<br/>сделки</h3>
                <div class="text-1 _1">Пройдите экспертизу и узнайте необходимо ли вам обращаться в МАРТ для совершения сделки</div>
                <router-link class="go_to_exp_text_color" :to="{ name: 'expertise' }"><a target="_blank" class="button w-button">Пройти экспертизу</a></router-link>

            </div></div>
                <div class="column-4 w-col w-col-6 w-col-small-small-stack"><div class="div-block-helper"><h3 class="heading-2">Помощник подготовки документов</h3>
                    <div class="text-1">Подготовка всех необходимых документов для подачи в МАРТ</div>
                    <router-link class="go_to_exp_text_color" :to="{ name: 'doc_subject' }"><a  class="button-2 w-button">Подготовить документы</a></router-link></div></div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        data(){
            return {

            }
        },
        mounted() {
// this.is_admin_add();
        },
        created(){
        },
        methods: {

            // is_admin_add()
            // {
            //     axios.get('/is_admin').then(({ data }) => (
            //             this.$store.dispatch('setIsAdmin', data)
            //         )
            //     )
            // }

        }

    }
</script>
