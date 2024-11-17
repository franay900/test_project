import api from '../../api';

const state = {
    users: null,
    user:null,
    roles: null,
    selectedRoles: null
}

const getters = {
    users: state => state.users,
    user: state => state.user,
    roles: state => state.roles,
    selectedRoles: state => state.selectedRoles
}

const actions = {
    getUsers({commit}){
        api.get('users')
        .then(res => {
            
           commit('setUsers', res.data.data)
          
        })
        .catch(error => {
            console.error(error);
           
        })

    },
    getUser({state,commit,dispatch}, id){
        api.get(`users/${id}`)
        .then(res => {
            
            commit('setUser', res.data.data)

            commit('setselectedRoles', res.data.data.roles)
        })
    },

    getRoles({state,commit,dispatch}){

        api.get('roles')
        .then(res=>{
            commit('setRoles', res.data)
        }

        )
    },

}

const mutations = {
    setUsers(state,users){
        state.users = users
    },
    setUser(state,user){
        state.user = user
    },

    setRoles(state, roles){
        state.roles = roles
    },

    setselectedRoles(state, userRoles){
        
        state.selectedRoles = userRoles
    }
}

export default {
    state, mutations, getters, actions
}

// import router from "../../router.js";


// const state = {
//     user: null,
//     users: null
// }

// const getters= {
//     user: state =>  state.user ,
//     users: state => state.users
// }

// const actions = {
//     getUser({state, commit, dispatch}, id){
//         axios.get('/api/users/' + id)
//             .then( res => {

//                 commit('setUser', res.data.data)


//             })
//     },

//     getUsers({commit}) {
//         axios.get('/api/users')
//             .then(res => {
//                 commit('setUsers', res.data.data);

//             })
//     },

//     deleteUser({dispatch},id) {
//         axios.delete('/api/users/' + id)
//             .then(res => {
//                 dispatch('getUsers');
//             })
//     },

//     updateUser({}, data) {
//         axios.patch('/api/users/' + data.id, {name: data.name, surname: data.surname})
//             .then(res => {

//                 router.push({name: 'user.show', params: {id: data.id} })
//             })
//     },

//     store({}, data){
//         axios.post('/api/users', {name: data.name, surname: data.surname})
//             .then( res => {
//                 router.push({name: 'user.index'})

//             })
//     },





// }

// const mutations = {
//     setUser(state, user){
//         state.user = user;
//     },
//     setUsers(state, users) {
//         state.users = users;
//     }
// }


// export default {
//     state, mutations, getters, actions
// }
