<template>
    <CategoryTopMenu/>
    <div class="product-list mt-10">
        <div class="grid gap-10 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 s:grid-cols-1">
            <ProductComponent :products="products"/>
        </div>
    </div>
</template>

<script>
import CategoryTopMenu from "@/components/menu/CategoryTopMenu.vue";
import {mapActions} from "vuex";
import ProductComponent from "@/components/product/ProductComponent.vue";

export default {
    components: {ProductComponent, CategoryTopMenu},
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
