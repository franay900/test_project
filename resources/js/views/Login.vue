<script>

import axios from 'axios'


export default {
    name: 'Login',
    data() {
        return {
            email: null,
            password: null,
            invalidLogin: false
        }
    },


    methods: {
        login(){
            axios.post('/api/auth/login', {email: this.email, password:this.password})
                .then(res=>{

                    localStorage.access_token = res.data.access_token
                    this.$router.push({name: 'dashboard'})
                })
                .catch(error =>{
                    this.invalidLogin = true;
                    console.error(error)
                })
        }
    },
}
</script>

<template>


    <div class=" ">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                    <div class="card border border-light-subtle rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">

                                        <h4 class="text-center">Welcome!</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="#!">
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input v-model="email" type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input v-model="password" type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button @click.prevent="login" class="btn bsb-btn-xl btn-primary" type="submit">Log in now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
