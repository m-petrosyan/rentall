import {createRouter, createWebHistory} from 'vue-router'
import ClientLayouth from "../components/layouts/ClientLayouth.vue";
import HomePage from "@/pages/HomePage.vue";
import ProductPage from "@/pages/ProductPage.vue";
import CardPage from "@/pages/CardPage.vue";

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
                path: 'card',
                name: 'card',
                component: CardPage
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
