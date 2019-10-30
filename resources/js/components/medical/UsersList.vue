<template>
    <div class="col">
<div>Общий список пользователей</div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col-1">id</th>
                <th scope="col-3">Имя пользователя</th>
                <th scope="col-3">Email пользователя</th>
                <th scope="col-3">Роль</th>
                <th scope="col-2">Забанен</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="(user) in users">
                <td scope="col-1">
                    {{ user.id }}
                </td>
                <td scope="col-3">
                    {{ user.name }}
                </td>
                <td scope="col-3">
                    {{ user.email }}
                </td>
                <td scope="col-3">
                    <select v-model=user.user_status>
                        <option v-bind:value='1' v-on:click="change_user_role(user.id,user.user_status)">Админ</option>
                        <option v-bind:value='2' v-on:click="change_user_role(user.id,user.user_status)">Редактор</option>
                        <option v-bind:value='3' v-on:click="change_user_role(user.id,user.user_status)">Пользователь</option>
                    </select>
                </td>
                <td scope="col-2">
                    <select v-model=user.banned>
                        <option v-bind:value='0' v-on:click="change_user_banned(user.id,user.banned)">Не забанен</option>
                        <option v-bind:value='1' v-on:click="change_user_banned(user.id,user.banned)">Забанен</option>
                    </select>

                </td>

            </tr>

            </tbody>
        </table>


        <div v-on:click="render_table(users)"><v-pagination v-if="total_pages!=0"  v-model="currentPage"  :page-count=total_pages :classes="bootstrapPaginationClasses"></v-pagination></div>
        <button type="button" class="btn btn-primary btn-block procedure_button" v-on:click="test">test</button>





    </div>
</template>
<script>

    export default {

        data(){

            return {
                //главный массив постов
                users: [],
                currentPage: 1,
                total_pages:0,
                bootstrapPaginationClasses: {
                    ul: 'pagination',
                    li: 'page-item',
                    liActive: 'active',
                    liDisable: 'disabled',
                    button: 'page-link'
                },

            }
        },
        mounted() {
            this.render_table(this.users);
        },

        methods: {
test()
{
    console.log(this.users);
},




            change_user_banned(user_id, user_banned)
            {
                axios
                    .post('/change_user_banned',{
                        user_id:user_id,
                        user_banned:user_banned
                    })

            },

            change_user_role(user_id,user_role)
            {
                axios
                    .post('/change_user_role',{
                        user_id:user_id,
                        user_role:user_role
                    })
            },

            render_table(inp)
            {

                axios
                    .post('/users_list_pagination',{
                        offset:this.currentPage,
                    })
                    .then(({ data }) => (
                        inp=[],
                                data.forEach(function(entry) {
                                    if(entry.user_status==null)
                                    {
                                        return
                                    }
                                    else
                                    {
                                        entry.banned=entry.user_status.banned,
                                        entry.user_status=entry.user_status.status
                                    }
                                    inp.push({
                                    id:entry.id,
                                    name:entry.name,
                                    email:entry.email,
                                    user_status:entry.user_status,
                                    banned:entry.banned
                                });
                        }),
                        this.users=inp
                    )

                );

                this.getTotalCountUsers();

            },

            getTotalCountUsers()
            {
                axios
                    .post('/users_list',{
                    }).then(({ data }) => (
                        this.total_pages=Math.ceil((data.length)/3)
                ));
            }



        },

    }
</script>
