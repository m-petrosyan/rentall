import {getRequest} from "@/store/api";

export default {
    state: {
        kit: null,
        kits: null,
        kitOptions: null,
        kitError: null
    },
    getters: {
        kits: state => state.kits,
        kit: state => state.kit,
        kitOptions: state => state.kitOptions,
        kitError: state => state.kitError,
    },
    mutations: {
        setKits(state, data) {
            state.kits = data
        },
        setKit(state, data) {
            state.kits = data
        },
        setKitOptions(state, data) {
            state.kitOptions = data
        },
        setKitError(state, data) {
            state.kitError = data
        },
    },
    actions: {
        getKit({commit}, id) {
            return getRequest(`/kit/${id}`)
                .then(response => {
                    commit("setKit", response.data)
                    commit('setKitError', null)
                })
                .catch(error => {
                    commit('setKitError', error)
                    return Promise.reject(error)
                });
        },
        getKits({commit}, paginate) {
            return getRequest(`/kit`, paginate)
                .then(response => {
                    commit("setKits", response)
                    // commit('setProductError', null)
                })
                .catch(error => {
                    // commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
        createKit({commit}, data) {
            return postRequest(`/kit`, data)
                .then(response => {
                    // commit("setCategories", response)
                    commit('setKitError', null)
                })
                .catch(error => {
                    commit('setKitError', error)
                    return Promise.reject(error)
                });
        },
        updateKit({commit}, data) {
            return putRequest(`/kit/${data.id}`, data.kit)
                .then(response => {
                    // commit("setCategories", response)
                    commit('setKitError', null)
                })
                .catch(error => {
                    commit('setCategoryError', error)
                    return Promise.reject(error)
                });
        },
        deleteKit({commit}, id) {
            return deleteRequest(`/kit/${id}`)
                .then(response => {
                    commit('setKitError', null)
                })
                .catch(error => {
                    commit('setKitError', error)
                    return Promise.reject(error)
                });
        },
        optionsKit({commit}, id) {
            return getRequest(`/kit-options`)
                .then(response => {
                    commit("setOptions", response)
                    commit('setKitError', null)
                })
                .catch(error => {
                    commit('setKitError', error)
                    return Promise.reject(error)
                });
        },
    },
}
