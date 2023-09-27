<template>
    <div class="product-page mt-20" v-if="product">
        <div class="product flex gap-x-10">
            <div class="image w-1/2" :style="{backgroundImage: `url(${product.image})`}"/>
            <div class="info w-1/2">
                <h3 class="title font-bold">{{ product.title }}</h3>
                <p class="price">{{ product.brand.title }}</p>
                <h2 class="title mt-4 font-bold">{{ totalPrice }} AMD</h2>
                <div class="kits flex flex-col gap-y-3 mt-2">
                    <div class="kit" v-for="(kit, index) in product.kits" :key="kit.id">
                        <p class="price">{{ kit.title }}</p>
                        <select v-model="options[index]">
                            <option selected :value="{price: 0}"> none</option>
                            <option v-for="option in kit.options" :key="option.id"
                                    :value="{id:option.id, price: option.price}">
                                {{ option.title }}
                            </option>
                        </select>
                    </div>
                    <button class="card">Add to cart</button>
                    <div v-html="product.description"/>
                </div>
            </div>
        </div>
        <div class="flex mt-20 gap-x-6">
            <!--            <ProductComponent :products="product.similar_products"/>-->
            <ProductSimilarSliderComponent :products="product.similar_products"/>
        </div>
    </div>
</template>

<script>

import {mapActions} from "vuex";
import ProductComponent from "@/components/product/ProductComponent.vue";
import ProductSimilarSliderComponent from "@/components/product/ProductSimilarSliderComponent.vue";

export default {
    components: {ProductComponent, ProductSimilarSliderComponent},
    data() {
        return {
            options: []
        }
    },
    mounted() {
        this.getProduct(this.$route.params.id)
    },
    methods: {
        ...mapActions(['getProduct'])
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
            return total + this.product.price
        }
    },
}

</script>


<style scoped>

</style>
