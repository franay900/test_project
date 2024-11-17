<script>
import api from "../../api.js";

export default {
    name: "Index",
    data(){
        return {
           users: null
        }
    },
    methods: {
        getUsers(){
            api.get('users').then(res => {
                this.users = res.data.data

            })
        },

        deleteUser(id){
            api.delete(`users/${id}`)
                .then(res => {
                    this.getUsers()
                })
        }
    },
    mounted() {
        this.getUsers();
    }
}
</script>

<template>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="user in users">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <button @click="deleteUser(user.id)" class="btn btn-outline-danger btn-sm " data-bs-toggle="tooltip" data-bs-placement="left" title="Активен">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <router-link class="btn btn-primary" :to="{name: 'user.create'}" tag="button">Добавить</router-link>

</template>

<style scoped>

</style>
