import {postRequest} from "@/store/api";

export default {
    state: {
        // products: null,
        // product: null,
        orderError: null,
    },
    getters: {
        // products: state => state.products,
        // product: state => state.product,
        getOrderError: state => state.orderError,
    },
    mutations: {
        setOrderError(state, data) {
            state.orderError = data
        },
        // setProducts(state, data) {
        //     state.products = data
        // },
        // setProduct(state, data) {
        //     state.product = data
        // },
    },
    actions: {
        // getProducts({commit}, paginate) {
        //     return getRequest(`/product`, paginate)
        //         .then(response => {
        //             commit("setProducts", response)
        //             commit('setProductError', null)
        //         })
        //         .catch(error => {
        //             commit('setProductError', error)
        //             return Promise.reject(error)
        //         });
        // },
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
        // getProduct({commit}, id) {
        //     return getRequest(`/product/${id}`)
        //         .then(response => {
        //             commit("setProduct", response.data)
        //             commit('setProductError', null)
        //         })
        //         .catch(error => {
        //             commit('setProductError', error)
        //             return Promise.reject(error)
        //         });
        // },
        // editProduct({commit}, id) {
        //     return getRequest(`/product/${id}/edit`)
        //         .then(response => {
        //             commit("setProduct", response)
        //             commit('setProductError', null)
        //         })
        //         .catch(error => {
        //             commit('setProductError', error)
        //             return Promise.reject(error)
        //         });
        // },
    },
}
