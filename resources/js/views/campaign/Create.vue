<script>
import api from "../../api.js";

export default {
    name: "Create",

    data(){
        return {
            name: null
        }
    },

    methods: {
        createCampaign(){
            api.post('campaigns', {name: this.name})
                .then(res => {
                    console.log(res.data.data);
                    this.$router.push({name: 'campaign.index'})
                })
        }
    }
}
</script>

<template>

    <div class="mb-3">
        <label for="name" class="form-label">Наименование</label>
        <input v-model="name" type="text" class="form-control" id="name">
    </div>

    <button class="btn btn-primary" @click="createCampaign">Создать</button>
</template>

<style scoped>

</style>
