import {getRequest, postRequest} from "../api";

export default {
    state: {
        auth: null,
        user: null,
        userError: null,
    },
    getters: {
        getAuth: state => state.auth,
        getUserError: state => state.userError,
    },
    mutations: {
        setToken(state, data) {
            sessionStorage.setItem('token', data)
        },
        setUserError(state, data) {
            state.userError = data
        },
        setAuth(state, data) {
            state.auth = data
        },
        setHistory(state, data) {
            state.auth.history = data
        },
    },
    actions: {
        signUp({commit}, data) {
            return postRequest('/user', data, commit)
                .then(() => {
                    commit('setUserError', null)
                })
                .catch(error => {
                    commit('setUserError', error.message)
                    return Promise.reject(error)
                });
        },
        signIn({commit}, data) {
            return postRequest('/oauth/token', {
                username: data.username,
                password: data.password,
                grant_type: 'password',
                client_id: import.meta.env.VITE_APP_CLIENT_ID,
                client_secret: import.meta.env.VITE_APP_CLIENT_SECRET
            })
                .then(response => commit("setToken", response.access_token))
                .catch(error => {
                    commit('setUserError', error)
                    return Promise.reject(error)
                });
        },
        auth({commit}) {
            return getRequest('/user')
                .then(response => {
                    commit("setAuth", response.data)
                    commit('setUserError', null)
                })
                .catch(error => {
                    sessionStorage.removeItem('token')
                    commit('setUserError', error.message)
                    return Promise.reject(error)
                })
        },
        getHistory({commit}) {
            return getRequest('/weather/history')
                .then(response => {
                    commit("setHistory", response.data)
                    commit('setUserError', null)
                })
                .catch(error => {
                    commit('setUserError', error.message)
                    return Promise.reject(error)
                })
        },
    },
}
