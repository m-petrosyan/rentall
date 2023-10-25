<template>
    <div v-if="products && !loading">
        <Splide v-if="products.data.slider" :options="slider" aria-label="My Favorite Images"
                class="w-screen relative ml-50vw h-500px left-1/2">
            <SplideSlide v-for="slide in products.data.slider" :key="slide.id">
                <router-link
                    :to="{name: 'product', params: { id: slide.id }}"
                    :style="{backgroundImage: `url(${slide.slider_image})`}"
                    class="block w-full h-full bg-cover bg-center bg-no-repeat">
                </router-link>
            </SplideSlide>
        </Splide>
        <div class="content mt-10">
            <input type="search" v-model="search" class="mx-auto block rounded-full border-gray-100"
                   placeholder="type here..."/>
            <CategoryTopMenu :categories="categories" v-model:category="paginate.category"
                             v-model:search="search"/>
            <div class="product-list mt-10">
                <div class="grid gap-10 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 s:grid-cols-1">
                    <ProductComponent :products="products.data.products"/>
                </div>
            </div>
        </div>
        <PaginationCreateComponent :meta="products.meta" :page="this.paginate.page" :route="'home-paginate'"/>
    </div>
    <Preloader v-else/>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import CategoryTopMenu from "@/components/menu/CategoryTopMenu.vue";
import ProductComponent from "@/components/product/ProductComponent.vue";
import {SplideSlide} from '@splidejs/vue-splide';
import Preloader from "@/pages/other/Preloader.vue";
import {debounce} from 'vue-debounce'
import PaginationCreateComponent from "@/components/parth/PaginationCreateComponent.vue";
import paginateMixin from "@/mixins/paginateMixin";

export default {
    components: {PaginationCreateComponent, Preloader, ProductComponent, CategoryTopMenu, SplideSlide},
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
                page: this.$route.params?.page ?? 1
            },
            search: null,
            loading: true,
        }
    },
    mounted() {
        this.getCategories()
        this.getProductsQuery()
        this.debouncedFetch = debounce(() => {
            this.loading = true
            this.getProductsQuery()
        }, 1000);
    },
    computed: {
        ...mapGetters(['categories', 'products']),
    },
    methods: {
        ...mapActions(['getProducts', 'getCategories']),
        getProductsQuery() {
            this.loading = true
            this.getProducts({...this.paginate, search: this.search}).then(() => {
                this.loading = false
            })
        }
    },
    watch: {
        paginate: {
            handler(newValue, oldValue) {
                console.log(newValue, oldValue)
                this.debouncedFetch()
            },
            deep: true
        },
        search(newValue, oldValue) {
            this.paginate.category = null
            this.$router.push({name: 'home-paginate', params: {page: 1}})
            this.debouncedFetch()
        },
    },
}
</script>


<style>

</style>
