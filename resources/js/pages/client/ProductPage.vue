<template>
    <div class="product-page" v-if="product && !loading">
        <div class="product flex md:gap-x-10 sm:gap-y-10 md:min-h-96 s:flex-col md:flex-row">
            <div class="image s:h-96 md:h-auto md:w-1/2 s:w-full bg-contain bg-no-repeat md:bg-left s:bg-top"
                 :style="{backgroundImage: `url(${product.main_image})`}"/>
            <div class="info md:w-1/2  s:w-full">
                <h3 class="title font-bold">{{ product.title }}</h3>
                <!--                <p class="price">{{ product.brand.title }}</p>-->
                <h2 class="title mt-4 font-bold">{{ totalPrice }} AMD</h2>
                <div class="kits flex flex-col gap-y-3 mt-2">
                    <div class="kit" v-for="(kit, index) in product.kits" :key="kit.id">
                        <p class="price">{{ kit.title }}</p>
                        <select v-model="options[index]">
                            <option selected :value="{price: 0}"> none</option>
                            <option v-for="option in kit.options" :key="option.id"
                                    :value="{id:option.id, price: option.price, title: option.title}">
                                {{ option.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-x-2 mt-8">
                    <CountButton v-model:count="count"/>
                    <button class="cart" @click="addToCart(product, options, totalPrice)">Add to cart</button>
                </div>

            </div>
        </div>
        <div class="mt-16" v-html="product.description"/>
        <div class="flex mt-20 gap-x-6">
            <Splide v-if="product.similars.length" :options="slider" aria-label="My Favorite Images"
                    class="w-full h-64">
                <SplideSlide v-for="slide in product.similars" :key="slide.id">
                    <router-link :to="{name: 'product', params: { id: slide.id }}"
                                 class="flex flex-col h-full">
                        <div class="image flex items-center">
                            <img :src="slide.main_image" alt="product">
                        </div>
                        <div class="flex flex-col gap-3 text-center">
                            <h3 class="title font-bold">{{ slide.title }}</h3>
                            <p class="price">{{ slide.price }}</p>
                        </div>
                        <!--                    <img :src="slide.slider_image" :alt="slide.title" class="w-screen">-->
                    </router-link>
                </SplideSlide>
            </Splide>
        </div>
        <!--        <ProductSimilarSliderComponent :products="product.similar_products"/>-->

    </div>
    <Preloader v-else/>
</template>

<script>

import {mapActions} from "vuex";
import ProductComponent from "@/components/product/ProductComponent.vue";
import ProductSimilarSliderComponent from "@/components/product/ProductSimilarSliderComponent.vue";
import CountButton from "@/components/elements/CountButton.vue";
import Preloader from "@/components/elements/Preloader.vue";


export default {
    components: {Preloader, CountButton, ProductComponent, ProductSimilarSliderComponent},
    props: {
        setStorage: Function
    },
    data() {
        return {
            slider: {
                perPage: window.innerWidth > 860 ? 4 : window.innerWidth > 580 ? 2 : 1,
                padding: '80px',
                lazyLoad: true,
                gap: '50px',
                interval: 5000,
                speed: 1000,
                autoplay: true,
                pauseOnHover: true,
            },
            loading: true,
            count: 1,
            options: []
        }
    },
    created() {
        this.getProductQuery().then(() => {
            this.loading = false
        })
    },
    methods: {
        ...mapActions(['getProduct']),
        async getProductQuery() {
            return this.getProduct(this.$route.params.id).then(() => this.loading = false)
        },
        addToCart() {
            const data = {
                id: this.product.id,
                title: this.product.title,
                image: this.product.main_image,
                options: this.options.filter(item => item.id),
                price: this.totalPrice
            }
            this.setStorage('cart', data)
        }
    },
    computed: {
        product() {
            const product = this.$store.getters.product
            for (let i = 0; i < product?.kits?.length; i++) {
                this.options.push({price: 0})
            }

            return product
        },
        totalPrice() {
            let total = 0
            this.options.forEach(item => total += item.price)
            return (total + this.product.price) * this.count
        }
    },
    watch: {
        $route(to, from) {
            if (from.params.id && to.params.id !== undefined && to.params.id !== from.params.id) {
                this.getProductQuery().then(() => {
                    this.slider.arrows = this.product?.similar_products.length > 4
                })
            }
        }
    }
}

</script>


<style scoped>
.splide__arrow {
    background: none !important;
}
</style>
