import {getRequest, postRequest} from "@/store/api";

export default {
    state: {
        rents: null,
        orderError: null,
    },
    getters: {
        rents: state => state.rents,
        getOrderError: state => state.orderError,
    },
    mutations: {
        setOrderError(state, data) {
            state.orderError = data
        },
        setRents(state, data) {
            state.rents = data
        },
    },
    actions: {
        getRents({commit}, paginate) {
            return getRequest(`/rent`, paginate)
                .then(response => {
                    commit("setRents", response)
                    commit('setOrderError', null)
                })
                .catch(error => {
                    commit('setOrderError', error)
                    return Promise.reject(error)
                });
        },
        createRent({commit}, data) {
            return postRequest(`/rent`, data)
                .then(response => {
                    // commit("setProduct", response.data)
                    commit('setOrderError', null)
                })
                .catch(error => {
                    commit('setOrderError', error)
                    return Promise.reject(error)
                });
        },
    },
}
