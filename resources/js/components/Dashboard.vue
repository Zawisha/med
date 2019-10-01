<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">DASHBOARD Component</div>

                    <div class="card-body">
                        I'm DASHBOARD

                        <router-link :to="{ name: 'login' }">Login</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                post_name:'1234'
            }
        },
    }
</script>
