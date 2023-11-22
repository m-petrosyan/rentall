<template>
    <div v-if="products && categories && !loading">
        <Splide v-if="products.data.slider.length" :options="slider" aria-label="My Favorite Images"
                class="w-screen relative ml-50vw h-500px left-1/2 s:hidden md:block">
            <SplideSlide v-for="slide in products.data.slider" :key="slide.id">
                <router-link
                    :to="{name: 'product', params: { id: slide.id }}"
                    :style="{backgroundImage: `url(${slide.slider_image})`}"
                    class="block w-full h-full bg-cover bg-center bg-no-repeat">
                </router-link>
            </SplideSlide>
        </Splide>
        <div class="content mt-10">
            <div class="flex">
                <!--                <div class="flex">-->
                <!--                    <button @click="brandToggle = !brandToggle"-->
                <!--                            class="pointer block mb-2 text-sm font-medium text-gray-900 dark:text-white">-->
                <!--                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="25"-->
                <!--                             height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none"-->
                <!--                             stroke-linecap="round" stroke-linejoin="round">-->
                <!--                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>-->
                <!--                            <path-->
                <!--                                d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"/>-->
                <!--                        </svg>-->
                <!--                    </button>-->
                <!--                    <select v-if="brandToggle" v-model="brand"-->
                <!--                            id="brand"-->
                <!--                            class="h-8 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">-->
                <!--                        <option v-for="brand in  brands.data" :key="brand.id" :value="brand.id">-->
                <!--                            {{ brand.title }}-->
                <!--                        </option>-->
                <!--                    </select>-->
                <!--                </div>-->
                <input type="search" v-model="paginate.search"
                       class="mx-auto block rounded-full border-gray-100 bg-gray-100"
                       placeholder="type here..."/>
            </div>
            <CategoryTopMenu :categories="categories"
                             v-model:category="paginate.category"
                             v-model:search="paginate.search"
                             v-model:page="paginate.page"
            />
            <div class="product-list mt-10">
                <div class="grid gap-10 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 s:grid-cols-1">
                    <ProductComponent :products="products.data.products"/>
                </div>
            </div>
        </div>
        <PaginationCreateComponent
            :meta="products.meta"
            :page="this.paginate.page"
            :route="'home-paginate'"
            :getData="getData"
        />
    </div>
    <Preloader v-else/>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import {SplideSlide} from '@splidejs/vue-splide';
import {debounce} from 'vue-debounce'
import CategoryTopMenu from "@/components/menu/CategoryTopMenu.vue";
import ProductComponent from "@/components/product/ProductComponent.vue";
import PaginationCreateComponent from "@/components/elements/PaginationCreateComponent.vue";
import paginateMixin from "@/mixins/paginateMixin";
import Preloader from "@/components/elements/Preloader.vue";

export default {
    components: {Preloader, PaginationCreateComponent, ProductComponent, CategoryTopMenu, SplideSlide},
    mixins: [paginateMixin],
    data() {
        return {
            slider: {
                interval: 10000,
                speed: 1000,
                autoplay: true,
                gap: 0,
                cover: true,
                pauseOnHover: true,
                rewind: true,
                height: '500px',
            },
            paginate: {
                category: null,
                limit: 12,
                page: this.$route.params?.page ?? 1,
                search: null,
            },
            brand: null,
            brandToggle: false,
            loading: true,
            actions: ['getProducts', 'getCategories']
        }
    },
    mounted() {
        this.getCategories()
        this.getBrands({page: 1, limit: 100})
        this.getData().then(() => {
            this.loading = false
        })
        this.debouncedFetch = debounce(() => {
            this.paginate.page = 1
            this.getData()
        }, 1500);
    },
    computed: {
        ...mapGetters(['categories', 'products', 'brands']),
    },
    methods: {
        ...mapActions(['getProducts', 'getCategories', 'getBrands']),
        async getData() {
            return await this.getProducts({...this.paginate})
        }
    },
    watch: {
        // category() {
        //     alert()
        //     this.getData()
        // },
        "paginate.search": {
            handler(val, oldVal) {
                this.paginate.category = null
                this.debouncedFetch()
            },
        },
        "paginate.category": {
            handler(val, oldVal) {
                this.getData()
            },
        },
        "paginate.page": {
            handler(val, oldVal) {
                this.getData()
            },
        },
        $route(to, from) {
            console.log(to.params.page)
            if (!to.params.page) {
                this.paginate.page = 1
            }
        },
    },
}
</script>


<style>

</style>
