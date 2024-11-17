<script>
export default {
    name: "Login",

    data() {
        return {
            email: null,
            password: null,
            is_invalid: ''
        }
    },

    methods:{
        login(){

            axios.post('/api/auth/login', {email: this.email, password:this.password})
                .then(res=>{
                    this.is_invalid = ''
                    localStorage.access_token = res.data.token
                    this.$router.push({name: 'campaign.index'})
                })
                .catch(error =>{
                    this.is_invalid = 'is-invalid'

                    console.error(error)
                })
        }
    }
}
</script>

<template>

    <div class="container col-6 " style="margin-top: 240px">
        <div class="mb-3 ">
            <label for="exampleInputEmail1" class="form-label">Email </label>
            <input v-model="email" type="email" :class="`form-control ${is_invalid}`" id="exampleInputEmail1" aria-describedby="emailHelp" >

            <div class="invalid-feedback">
            Неправильный логин или пароль

            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input v-model="password" type="password" :class="`form-control ${is_invalid}`" id="exampleInputPassword1">
        </div>

        <button  class="btn btn-primary" @click="login">Войти</button>
    </div>

</template>

<style scoped>

</style>
