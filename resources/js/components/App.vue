<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <nav>
                <ul class="list-inline">
<!--                    <li class="pull-right">-->
<!--                        <router-link :to="{ name: 'login' }">Login</router-link>-->
<!--                    </li>                    <li class="pull-right">-->
<!--                    <router-link :to="{ name: 'register' }">Register</router-link>-->
<!--                </li>-->
<!--                    <li>-->
<!--                        <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>-->
<!--                    </li>-->
<!-- -&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;-->
<!--                    <li v-if="!$auth.check()" class="pull-right">-->
<!--                        <router-link :to="{ name: 'register' }">Register</router-link>-->
<!--                    </li>-->
<!--                    <li v-if="$auth.check()" class="pull-right">-->
<!--                        <a href="#" @click.prevent="$auth.logout()">Logout</a>-->
<!--                    </li>-->


<!--                    <li>-->
<!--                        <router-link :to="{ name: 'dashboard' }">Forgot the password</router-link>-->
<!--                    </li>-->

                </ul>
            </nav>
        </div>
        <div class="panel-body">
            <router-view></router-view>
        </div>
    </div>
</template>
