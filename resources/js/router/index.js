import {createRouter, createWebHistory} from 'vue-router'
import ClientLayouth from "../components/layouts/ClientLayouth.vue";
import AdminLayouth from "@/components/layouts/AdminLayouth.vue";

//client
import HomePage from "@/pages/client/HomePage.vue";
import ProductPage from "@/pages/client/ProductPage.vue";
import CartPage from "@/pages/client/CartPage.vue";

//admin
import LoginPage from "@/pages/dashboard/LoginPage.vue";
import Dashboard from "@/pages/dashboard/Dashboard.vue";
// import CategoryEditPage from "@/pages/dashboard/Category/CategoryEditPage.vue";
import CategoryListPage from "@/pages/dashboard/category/CategoryListPage.vue";
import ProductListPage from "@/pages/dashboard/product/ProductListPage.vue";
import ProductCreateEditPage from "@/pages/dashboard/product/ProductCreateEditPage.vue";

//other
import NotFound404 from "@/pages/other/NotFound404.vue";


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
                        component: CategoryListPage,
                    },
                    {
                        path: 'product',
                        children: [
                            {
                                path: '',
                                name: 'db-product',
                                component: ProductListPage,
                            },
                            {
                                path: 'create',
                                name: 'db-productcreate',
                                component: ProductCreateEditPage,
                            },
                            {
                                path: ':id/update',
                                name: 'db-productupdate',
                                component: ProductCreateEditPage,
                            }
                        ]
                    },
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
