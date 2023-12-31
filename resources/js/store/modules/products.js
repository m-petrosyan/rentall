import {deleteRequest, getRequest, postRequest} from "@/store/api";

export default {
    state: {
        products: null,
        product: null,
        options: null,
        productError: null,
    },
    getters: {
        products: state => state.products,
        product: state => state.product,
        options: state => state.options,
        getProductError: state => state.productError,
    },
    mutations: {
        setProductError(state, data) {
            state.productError = data
        },
        setProducts(state, data) {
            state.products = data
        },
        setOptions(state, data) {
            state.options = data
        },
        setProduct(state, data) {
            state.product = data
        },
    },
    actions: {
        getProducts({commit}, paginate) {
            return getRequest(`/product`, paginate, commit)
                .then(response => {
                    commit("setProducts", response)
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
        editProduct({commit}, id) {
            return getRequest(`/product/${id}/edit`)
                .then(response => {
                    commit("setProduct", response)
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
        optionsProduct({commit}, id) {
            return getRequest(`/product-options`)
                .then(response => {
                    commit("setOptions", response)
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
        createProduct({commit}, data) {
            return postRequest(`/product`, data)
                .then(response => {
                    // commit("setProduct", response.data)
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
        updateProduct({commit}, data) {
            return postRequest(`/product/${data.id}`, data.data)
                .then(response => {
                    // commit("setProduct", response.data)
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
        deleteProduct({commit}, id) {
            return deleteRequest(`/product/${id}`)
                .then(response => {
                    commit('setProductError', null)
                })
                .catch(error => {
                    commit('setProductError', error)
                    return Promise.reject(error)
                });
        },
    },
}
