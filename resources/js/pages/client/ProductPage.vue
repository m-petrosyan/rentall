<template>
    <div class="product-page" v-if="product">
        <div class="product flex md:gap-x-10 sm:gap-y-10 md:min-h-96 sm:flex-col md:flex-row">
            <div class="image s:h-96 md:h-auto md:w-1/2 sm:w-full bg-contain bg-no-repeat md:bg-left s:bg-top"
                 :style="{backgroundImage: `url(${product.image})`}"/>
            <div class="info md:w-1/2  sm:w-full">
                <h3 class="title font-bold">{{ product.title }}</h3>
                <p class="price">{{ product.brand.title }}</p>
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
            <ProductSimilarSliderComponent :products="product.similar_products"/>
        </div>
    </div>
</template>

<script>

import {mapActions} from "vuex";
import ProductComponent from "@/components/product/ProductComponent.vue";
import ProductSimilarSliderComponent from "@/components/product/ProductSimilarSliderComponent.vue";
import CountButton from "@/components/elements/CountButton.vue";

export default {
    components: {CountButton, ProductComponent, ProductSimilarSliderComponent},
    props: {
        setStorage: Function
    },
    data() {
        return {
            count: 1,
            options: []
        }
    },
    mounted() {
        this.getProductQuery()
    },
    methods: {
        ...mapActions(['getProduct']),
        getProductQuery() {
            this.getProduct(this.$route.params.id)
        },
        addToCart() {
            const data = {
                id: this.product.id,
                title: this.product.title,
                image: this.product.image,
                options: this.options.filter(item => item.id),
                price: this.totalPrice
            }
            this.setStorage('cart', data)
        }

    },
    computed: {
        product() {
            const product = this.$store.getters.getProduct
            for (let i = 0; i < product?.kits.length; i++) {
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
                this.getProductQuery()
            }
        }
    }
}

</script>


<style scoped>

</style>
