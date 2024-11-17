<script>
import api from "../../api.js";

export default {
    name: "Edit",

    data(){
        return {
            ad: null,
        }
    },

    methods:{
        getAd(){
            api.get(`ads/${this.$route.params.id}`)
                .then(res => {
                    this.ad = res.data.data

                })
        },

        updateAd(){
            api.patch(`ads/${this.$route.params.id}`, {text: this.ad.text, budget: this.ad.budget})
                .then(res => {
                    this.$router.push({name: 'ad.index'})
                })
                .catch(error=>{
                    console.log(error)
                })
        }
    },

    mounted() {
        this.getAd()
    }
}
</script>

<template>
    <div v-if="ad">
    <h1>{{ ad.title }}</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Текст объявления</label>
        <textarea v-model="ad.text" class="form-control" aria-label="With textarea" ></textarea>
    </div>


    <div class="mb-3">
        <label for="name" class="form-label">Бюджет</label>
        <input type="number" v-model="ad.budget" class="form-control">
    </div>
    <button @click="updateAd" class="btn btn-primary">Обновить</button>
    </div>
</template>

<style scoped>

</style>
