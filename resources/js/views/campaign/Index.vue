<script>
import api from "../../api.js";

export default {
    name: "Index",



    methods: {
        getCampaigns(){
            api.get('campaigns')
                .then(res => {
                    this.campaigns = res.data.data
                })
        },

        setStatus(status, id){
            api.patch(`campaigns/${id}`, {status: status})
                .then(res => {
                    this.$store.dispatch('getCampaigns')
                })
        }
    },

    mounted() {
        this.$store.dispatch('getCampaigns')


    },

    computed: {

        campaigns(){
            return this.$store.getters.campaigns
        }

    }
}




</script>

<template>


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="campaign in campaigns">
            <td>{{ campaign.name }}</td>
            <td>{{ campaign.status }}</td>
            <td>
                <button @click="setStatus('В архиве', campaign.id)" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="В архив">
                    <i class="bi bi-archive"></i>


                </button>
                <button @click="setStatus('В ожидании', campaign.id)" class="btn btn-outline-primary btn-sm " data-bs-toggle="tooltip" data-bs-placement="left" title="В ожидании">
                    <i class="bi bi-hourglass"></i>
                </button>
                <button @click="setStatus('Активен', campaign.id)" class="btn btn-outline-primary btn-sm " data-bs-toggle="tooltip" data-bs-placement="left" title="Активен">
                    <i class="bi bi-brightness-high"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>

    <router-link class="btn btn-primary" :to="{name: 'campaign.create'}" tag="button">Добавить</router-link>

</template>

<style scoped>

</style>
