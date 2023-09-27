import {getRequest} from "@/store/api";

export default {
    state: {
        products: null,
        product: null,
        productError: null,
    },
    getters: {
        getProducts: state => state.products,
        getProduct: state => state.product,
        getProductError: state => state.productError,
    },
    mutations: {
        setProductError(state, data) {
            state.productError = data
        },
        setProducts(state, data) {
            state.products = data
        },
        setProduct(state, data) {
            state.product = data
        },
    },
    actions: {
        getProducts({commit}, paginate) {
            return getRequest(`/product`, paginate)
                .then(response => {
                    commit("setProducts", response.data)
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
        getProduct({commit}, id) {
            return getRequest(`/product/${id}`)
                .then(response => {
                    commit("setProduct", response.data)
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
    },
}
