<template>
    <div class="slider flex align-center justify-between">
        <ArrowButton v-model:index="currentIndex" :length="this.products.length" :next="false"/>
        <div class="flex gap-x-5 w-11/12">
            <ProductComponent :products="displayedItems"/>
        </div>
        <ArrowButton v-model:index="currentIndex" :length="this.products.length" :next="true"/>
    </div>
</template>

<script>
import ProductComponent from "@/components/product/ProductComponent.vue";
import ArrowButton from "@/components/elements/ArrowButton.vue";

export default {
    components: {ArrowButton, ProductComponent},
    props: {
        products: Array
    },
    data() {
        return {
            currentIndex: 0,
            itemsPerPage: 0
        }
    },
    mounted() {
        this.perPage()
        window.addEventListener('resize', this.perPage);
    },
    computed: {
        displayedItems() {
            const start = this.currentIndex;
            const end = start + this.itemsPerPage;

            if (end > this.products.length) {
                return [
                    ...this.products.slice(start),
                    ...this.products.slice(0, end - this.products.length),
                ];
            } else {
                return this.products.slice(start, end);
            }
        },
    },
    methods: {
        perPage() {
            this.itemsPerPage = window.innerWidth > 860 ? 4 : window.innerWidth > 580 ? 2 : 1
        },
    },
};
</script>

<style scoped>

</style>
