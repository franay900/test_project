<script>
import api from "../api.js";

export default {
    name: "AppLayout",

    data(){
        return {
            me: null
        }
    },

    methods: {
        getMe(){
            api.post('auth/me')
                .then(res => {
                    this.me = res.data
                })
        }
    },

    mounted() {
        this.getMe()
    }
}
</script>

<template>


    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Navbar</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item" >
                        <router-link class="nav-link " :to="{name: 'dashboard'}" tag="button">Dashboard</router-link>
                    </li>

                    <li class="nav-item" >
                        <router-link class="nav-link " :to="{name: 'settings'}" tag="button">Settings</router-link>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <div class="container mt-3">
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
