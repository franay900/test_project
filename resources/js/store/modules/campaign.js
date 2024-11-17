import api from '../../api';

const state = {
    campaigns: null
}

const getters = {
    campaigns: state => state.campaigns
}

const actions = {
    getCampaigns({state,commit, dispatch}) {
        api.get('campaigns')
            .then(res => {
                commit('setCampaigns', res.data.data)
            })
    }
}


const mutations = {
    setCampaigns(state, campaigns){
        state.campaigns = campaigns
    }
}

export default {state, getters, actions, mutations}
