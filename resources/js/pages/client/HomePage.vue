<template>
    <div v-if="products && !loading">
        <Splide v-if="products" :options="slider" aria-label="My Favorite Images"
                class="w-screen relative ml-50vw h-500px left-1/2">
            <SplideSlide v-for="slide in products.data.slider" :key="slide.id">
                <router-link
                    :to="{name: 'product', params: { id: slide.id }}"
                    :style="{backgroundImage: `url(${slide.slider_image})`}"
                    class="block w-full h-full bg-cover bg-center bg-no-repeat">
                    <!--                    <img :src="slide.slider_image" :alt="slide.title" class="w-screen">-->
                </router-link>
            </SplideSlide>
        </Splide>
        <div class="content mt-10">
            <CategoryTopMenu/>
            <div class="product-list mt-10" v-if="products">
                <div class="grid gap-10 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 s:grid-cols-1">
                    <ProductComponent :products="products.data.products"/>
                </div>
            </div>
        </div>
    </div>
    <Preloader v-else/>
</template>

<script>
import {mapActions} from "vuex";
import CategoryTopMenu from "@/components/menu/CategoryTopMenu.vue";
import ProductComponent from "@/components/product/ProductComponent.vue";
import {SplideSlide} from '@splidejs/vue-splide';
import Preloader from "@/pages/other/Preloader.vue";

export default {
    components: {Preloader, ProductComponent, CategoryTopMenu, SplideSlide},
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
                limit: 12,
                page: 1
            },
            loading: true,
        }
    },
    mounted() {
        this.getProducts(this.paginate).then(() => {
            this.loading = false
        })
    },
    computed: {
        products() {
            return this.$store.getters.getProducts
        }
    },
    methods: {
        ...mapActions(['getProducts'])
    }
}
</script>


<style>
.splide {
//margin-left: -50vw
}
</style>
