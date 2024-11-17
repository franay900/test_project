import { createStore } from 'vuex'
import campaignModule from "./modules/campaign";



const store = createStore({
    modules: {
        campaign: campaignModule
    }
})

export default store
