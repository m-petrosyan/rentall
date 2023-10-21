<template>
    <router-link :to="{name: 'product', params: { id: product.id }}" class="product flex flex-col text-center"
                 v-for="product in products"
                 :key="product.id">
        <div class="image h-52 flex items-center">
            <img class="w-full max-h-full" :src="product.main_image" alt="product">
        </div>
        <div class="flex flex-col gap-3">
            <h3 class="title font-bold">{{ product.title }}</h3>
            <p class="price">{{ product.price }}</p>
        </div>
    </router-link>
</template>

<script>
export default {
    props: {
        products: Array
    }
}
</script>


<style scoped>

</style>
