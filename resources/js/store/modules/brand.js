import {deleteRequest, getRequest, postRequest, putRequest} from "@/store/api";

export default {
    state: {
        brands: null,
        brand: null,
        brandError: null,
    },
    getters: {
        brands: state => state.brands,
        brand: state => state.brand,
        brandError: state => state.brandError,
        // getProduct: state => state.product,
        // getProductError: state => state.productError,
    },
    mutations: {
        setBrandError(state, data) {
            state.brandError = data
        },
        setBrand(state, data) {
            state.brand = data
        },
        setBrands(state, data) {
            state.brands = data
        },
        // setProduct(state, data) {
        //     state.product = data
        // },
    },
    actions: {
        getBrand({commit}, id) {
            return getRequest(`/brand/${id}`)
                .then(response => {
                    commit("setBrand", response.data)
                    commit('setBrandError', null)
                })
                .catch(error => {
                    commit('setBrandError', error)
                    return Promise.reject(error)
                });
        },
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
        createBrand({commit}, data) {
            return postRequest(`/brand`, data)
                .then(response => {
                    // commit("setCategories", response)
                    commit('setBrandError', null)
                })
                .catch(error => {
                    commit('setBrandError', error)
                    return Promise.reject(error)
                });
        },
        updateBrand({commit}, data) {
            return putRequest(`/brand/${data.id}`, data.brand)
                .then(response => {
                    // commit("setCategories", response)
                    commit('setBrandError', null)
                })
                .catch(error => {
                    commit('setCategoryError', error)
                    return Promise.reject(error)
                });
        },
        deleteBrand({commit}, id) {
            return deleteRequest(`/brand/${id}`)
                .then(response => {
                    commit('setBrandError', null)
                })
                .catch(error => {
                    commit('setBrandError', error)
                    return Promise.reject(error)
                });
        },
    },
}
