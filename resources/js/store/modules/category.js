import {getRequest} from "@/store/api";

export default {
    state: {
        categories: null,
    },
    getters: {
        categories: state => state.categories,
        // getProduct: state => state.product,
        // getProductError: state => state.productError,
    },
    mutations: {
        // setCategoryError(state, data) {
        //     state.productError = data
        // },
        setCategories(state, data) {
            state.categories = data
        },
        // setProduct(state, data) {
        //     state.product = data
        // },
    },
    actions: {
        getCategories({commit}) {
            return getRequest(`/category`)
                .then(response => {
                    commit("setCategories", response)
                    // commit('setProductError', null)
                })
                .catch(error => {
                    // commit('setProductError', error)
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
