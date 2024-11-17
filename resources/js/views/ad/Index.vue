<script>
import api from "../../api.js";

export default {
    name: "Index",

    data(){
        return {
            ads: null
        }
    },

    methods: {
        getAds(){
            api.get('ads')
                .then(res => {
                    this.ads = res.data.data
                })
        }
    },

    mounted() {
        this.getAds()
    }

}
</script>

<template>

    <table class="table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th>Статус</th>
                <th>Показы</th>
                <th>CPM</th>
                <th>Бюджет</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="ad in ads">

                <td>{{ ad.title }}</td>
                <td>{{ ad.status }}</td>
                <td>{{ ad.impressions }}</td>
                <td>{{ ad.cpm }}</td>
                <td>{{ ad.budget }}</td>
                <td>

                    <router-link class="btn btn-outline-primary btn-sm" :to="{name: 'ad.edit', params: {id: ad.id}}" tag="button"><i class="bi bi-pen"></i></router-link>
                </td>
            </tr>
        </tbody>
    </table>

    <router-link class="btn btn-primary" :to="{name: 'ad.create'}" tag="button">Добавить</router-link>
</template>

<style scoped>

</style>
