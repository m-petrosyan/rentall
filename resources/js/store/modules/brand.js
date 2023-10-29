import {getRequest} from "@/store/api";

export default {
    state: {
        brands: null,
    },
    getters: {
        brands: state => state.brands,
        // getProduct: state => state.product,
        // getProductError: state => state.productError,
    },
    mutations: {
        // setCategoryError(state, data) {
        //     state.productError = data
        // },
        setBrands(state, data) {
            state.brands = data
        },
        // setProduct(state, data) {
        //     state.product = data
        // },
    },
    actions: {
        getBrands({commit}, paginate) {
            return getRequest(`/brand`, paginate)
                .then(response => {
                    commit("setBrands", response)
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
