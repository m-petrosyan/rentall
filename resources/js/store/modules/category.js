import {getRequest} from "@/store/api";
import {postRequest} from "../api";

export default {
    state: {
        categories: null,
        category: {},
        error: null,
    },
    getters: {
        categories: state => state.categories,
        category: state => state.category,
        // getProduct: state => state.product,
        categoryError: state => state.error,
    },
    mutations: {
        // setCategoryError(state, data) {
        //     state.productError = data
        // },
        setCategories(state, data) {
            state.categories = data
        },
        setCategoryError(state, data) {
            state.categoryError = data
        },
    },
    actions: {
        getCategories({commit}, paginate) {
            return getRequest(`/category`, paginate)
                .then(response => {
                    commit("setCategories", response)
                    commit('setCategoryError', null)
                })
                .catch(error => {
                    commit('setCategoryError', error)
                    return Promise.reject(error)
                });
        },
        createCategory({commit}, data) {
            return postRequest(`/category`, data)
                .then(response => {
                    // commit("setCategories", response)
                    commit('setCategoryError', null)
                })
                .catch(error => {
                    commit('setCategoryError', error)
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
