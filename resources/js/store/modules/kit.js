import {getRequest} from "@/store/api";

export default {
    state: {
        kits: null,
    },
    getters: {
        kits: state => state.kits,
        // getProduct: state => state.product,
        // getProductError: state => state.productError,
    },
    mutations: {
        // setCategoryError(state, data) {
        //     state.productError = data
        // },
        setKit(state, data) {
            state.kits = data
        },
        // setProduct(state, data) {
        //     state.product = data
        // },
    },
    actions: {
        getKits({commit}, paginate) {
            return getRequest(`/kit`, paginate)
                .then(response => {
                    commit("setKit", response)
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
