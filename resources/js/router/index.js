import {createRouter, createWebHistory} from 'vue-router'
import ClientLayouth from "../components/layouts/ClientLayouth.vue";
import HomePage from "@/pages/HomePage.vue";
import ProductPage from "@/pages/ProductPage.vue";
import CartPage from "@/pages/CartPage.vue";
import NotFound404 from "@/pages/NotFound404.vue";

const routes = [
    {
        path: '/',
        component: ClientLayouth,
        children: [
            {
                path: '',
                name: 'home',
                component: HomePage
            },
            {
                path: 'product/:id',
                name: 'product',
                component: ProductPage
            },
            {
                path: 'cart',
                name: 'cart',
                component: CartPage
            },
            {
                path: '/:pathMatch(.*)*',
                name: '404',
                component: NotFound404
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
