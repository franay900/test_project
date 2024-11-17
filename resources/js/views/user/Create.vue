<script>
import api from "../../api.js";

export default {
    name: "Create",

    data(){
        return {
            email: null,
            name: null,
            password: null
        }
    },
    methods: {
        createUser(){

            api.post('users', {name: this.name, email: this.email, password: this.password})
                .then(res => {
                    this.$router.push({name: 'user.index'})
                })

        }
    }
}
</script>

<template>



    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input v-model="name" type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input v-model="email" type="email" class="form-control" id="email" >

    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input v-model="password" type="password" class="form-control" id="password" >

    </div>

    <button  class="btn btn-primary" @click="createUser">Создать</button>

</template>

<style scoped>

</style>
