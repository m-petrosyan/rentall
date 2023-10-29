import {createStore} from 'vuex'

import products from "@/store/modules/products";
import category from "@/store/modules/category";
import rent from "@/store/modules/rent";
import user from "@/store/modules/user";


// Define a global variable using ref

export default createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        user,
        products,
        category,
        rent
    }
})
