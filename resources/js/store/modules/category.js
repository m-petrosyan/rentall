import {getRequest} from "@/store/api";
import {deleteRequest, postRequest, putRequest} from "../api";

export default {
    state: {
        categories: null,
        category: {},
        error: null,
    },
    getters: {
        categories: state => state.categories,
        category: state => state.category,
        categoryError: state => state.error,
    },
    mutations: {
        setCategories(state, data) {
            state.categories = data
        },
        setCategory(state, data) {
            state.category = data
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
        getCategory({commit}, id) {
            return getRequest(`/category/${id}`)
                .then(response => {
                    commit("setCategory", response.data)
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
        updateCategory({commit}, data) {
            return putRequest(`/category/${data.id}`, data.category)
                .then(response => {
                    // commit("setCategories", response)
                    commit('setCategoryError', null)
                })
                .catch(error => {
                    commit('setCategoryError', error)
                    return Promise.reject(error)
                });
        },
        deleteCategory({commit}, id) {
            return deleteRequest(`/category/${id}`)
                .then(response => {
                    commit('setCategoryError', null)
                })
                .catch(error => {
                    commit('setCategoryError', error)
                    return Promise.reject(error)
                });
        },
    },
}
