import {createStore} from 'vuex'
import products from "@/store/modules/products";
import category from "@/store/modules/category";

export default createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        products,
        category
    }
})
