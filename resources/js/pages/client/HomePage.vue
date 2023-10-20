<template>
    <Splide v-if="products" :options="{ rewind: true }" aria-label="My Favorite Images">
        <SplideSlide v-for="slide in products.data.slider" :key="slide.id">
            <img :src="slide.image" :alt="slide.title">
        </SplideSlide>
    </Splide>
    <CategoryTopMenu/>
    <div class="product-list mt-10" v-if="products">
        <div class="grid gap-10 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 s:grid-cols-1">
            <ProductComponent :products="products.data.products"/>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import CategoryTopMenu from "@/components/menu/CategoryTopMenu.vue";
import ProductComponent from "@/components/product/ProductComponent.vue";
import { Splide, SplideSlide } from '@splidejs/vue-splide';

export default {
    components: {ProductComponent, CategoryTopMenu,SplideSlide},
    data() {
        return {
            paginate: {
                limit: 12,
                page: 1
            }
        }
    },
    mounted() {
        this.getProducts(this.paginate)
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

</style>
