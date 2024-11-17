<script>
import api from "../../api.js";

export default {
    name: "Create",

    mounted() {
        this.$store.dispatch('getCampaigns')
    },

    data(){
        return {
            status: null,
            buttonText: null,
            title: null,
            text: null,
            url: null,
            impressions: null,
            cpm: null,
            budget: null,
            selectedCampaign: null
        }
    },

    methods: {
        createAd() {
            api.post('ads',
                {title: this.title,
                    text: this.text,
                    status: this.status,
                    cpm: this.cpm,
                    url: this.url, impressions:
                    this.impressions, budget:
                    this.budget, button_text:
                    this.buttonText,
                    campaign_id:
                    this.selectedCampaign})
                .then(res => {
                    this.$router.push({name: 'ad.index'})
                })
        }
    },

    computed: {

        campaigns(){
            return this.$store.getters.campaigns
        }

    }
}
</script>

<template>


    <div class="mb-3">
        <label for="name" class="form-label">Тайтл</label>
        <input v-model="title" type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Текст объявления</label>
        <textarea v-model="text" class="form-control" aria-label="With textarea"></textarea>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Статус</label>
        <div class="form-check">
            <input v-model="status" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"  value="Активен">
            <label class="form-check-label" for="flexRadioDefault1">
                Активен
            </label>
        </div>
        <div class="form-check">
            <input v-model="status"  class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  value="В ожидании">
            <label class="form-check-label" for="flexRadioDefault2">
                В ожидании
            </label>
        </div>
        <div class="form-check">
            <input v-model="status"  class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"  value="В архиве">
            <label class="form-check-label" for="flexRadioDefault3">
                В архиве
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">URL</label>
        <input v-model="url" type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Количество показов</label>
        <input v-model="impressions" type="number" class="form-control" id="name">
    </div>


    <div class="mb-3">
        <label for="name" class="form-label">CPM</label>
        <input v-model="cpm" type="number" step="0.1" class="form-control" id="name">
    </div>


    <div class="mb-3">
        <label for="name" class="form-label">Бюджет объявления</label>
        <input v-model="budget" type="number" step="0.1" class="form-control" id="name">

    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Текст кнопки объявления</label>
        <div class="form-check">
            <input v-model="buttonText" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" value="Смотреть">
            <label class="form-check-label" for="flexRadioDefault5">
                Смотреть
            </label>
        </div>
        <div class="form-check">
            <input v-model="buttonText" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" value="Оставить заявку">
            <label class="form-check-label" for="flexRadioDefault6" >
                Оставить заявку
            </label>
        </div>

        <div class="form-check">
            <input v-model="buttonText" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7" value="Скачать">
            <label class="form-check-label" for="flexRadioDefault7">
                Скачать
            </label>
        </div>

        <div class="form-check">
            <input v-model="buttonText" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8" value="Подробнее">
            <label class="form-check-label" for="flexRadioDefault8">
                Подробнее
            </label>
        </div>

    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Кампания</label>
        <select v-model="selectedCampaign" class="form-select form-select mb-3" aria-label=".form-select-lg example">

            <option   v-for="campaign in campaigns" :value="campaign.id">{{ campaign.name }}</option>

        </select>

    </div>

    <button @click="createAd" class="btn btn-primary">Добавить</button>

</template>

<style scoped>

</style>
