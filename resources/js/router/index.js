import {createRouter, createWebHistory} from 'vue-router'
import ClientLayouth from "../components/layouts/ClientLayouth.vue";
import AdminLayouth from "@/components/layouts/AdminLayouth.vue";

//client
import HomePage from "@/pages/client/HomePage.vue";
import ProductPage from "@/pages/client/ProductPage.vue";
import CartPage from "@/pages/client/CartPage.vue";
import NotFound404 from "@/pages/client/NotFound404.vue";

//admin
import LoginPage from "@/pages/dashboard/LoginPage.vue";
import Dashboard from "@/pages/dashboard/Dashboard.vue";
import CategoryCrudPage from "@/pages/dashboard/CategoryCrudPage.vue";
import ProductCrudPage from "@/pages/dashboard/ProductCrudPage.vue";

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
        ],

    },
    {
        path: '/',
        component: AdminLayouth,
        children: [
            {
                path: 'login',
                name: 'login',
                component: LoginPage
            },
            {
                path: 'dashboard',
                name: 'dashboard',
                component: Dashboard,
                children: [
                    {
                        path: '',
                        name: 'db-category',
                        component: CategoryCrudPage,
                    },
                    {
                        path: 'products',
                        name: 'db-product',
                        component: ProductCrudPage,
                    }
                ]
            }
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: NotFound404
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
