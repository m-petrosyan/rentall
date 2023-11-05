<template>
    <div v-if="products && !loading">
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
            <input type="search" v-model="paginate.search"
                   class="mx-auto block rounded-full border-gray-100 bg-gray-100"
                   placeholder="type here..."/>
            <CategoryTopMenu :categories="categories" v-model:category="paginate.category"
                             v-model:search="paginate.search"/>
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

            loading: true,
            actions: ['getProducts', 'getCategories']
        }
    },
    mounted() {
        this.getCategories()
        this.getData().then(() => {
            this.loading = false
        })
        this.debouncedFetch = debounce(() => {
            this.paginate.page = 1
            this.getData()
        }, 1500);
    },
    computed: {
        ...mapGetters(['categories', 'products']),
    },
    methods: {
        ...mapActions(['getProducts', 'getCategories']),
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
        // paginate: {
        //     handler(newValue, oldValue) {
        //         // this.loading = true
        //         console.log(newValue, oldValue)
        //         this.debouncedFetch()
        //     },
        //     deep: true
        // },
        // search(newValue, oldValue) {
        //     this.paginate.category = null
        //     // this.$router.push({name: 'home-paginate', params: {page: 1}})
        //     this.debouncedFetch()
        // },
    },
}
</script>


<style>

</style>
