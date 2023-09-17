<script>
import CategoryTopMenu from "@/components/menu/CategoryTopMenu.vue";

export default {
    components: {CategoryTopMenu},
    data() {
        return {}
    },
    computed: {
        products() {
            return this.$store.getters.getProducts
        }
    }
}
</script>

<template>
    <CategoryTopMenu/>
    <div class="product-list">
        <div class="grid gap-10 xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 s:grid-cols-1">
            <router-link :to="{name: 'product', params: { id: product.id }}" class="product flex flex-col text-center"
                         v-for="product in products"
                         :key="product.id">
                <div class="image">
                    <img class="w-full" :src="product.img" alt="product">
                </div>
                <div class="flex flex-col gap-3">
                    <h3 class="title font-bold">{{ product.title }}</h3>
                    <p class="price">{{ product.price }}</p>
                </div>
            </router-link>
        </div>
    </div>
</template>

<style>

</style>
