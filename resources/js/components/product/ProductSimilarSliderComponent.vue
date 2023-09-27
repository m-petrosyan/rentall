<template>
    <div id="app">
        <div class="slider flex align-center justify-center">
            <button @click="prev" class="m-6">Previous</button>
            <div class="flex gap-x-5">
                <ProductComponent :products="displayedItems"/>
            </div>
            <button @click="next" class="m-6">Next</button>
        </div>
    </div>
</template>

<script>
import ProductComponent from "@/components/product/ProductComponent.vue";

export default {
    components: {ProductComponent},
    props: {
        products: Array
    },
    data() {
        return {
            currentIndex: 0,
            itemsPerPage: 4,
        }
    },
    computed: {
        // Calculate the items to display based on the current index
        displayedItems() {
            const start = this.currentIndex;
            const end = start + this.itemsPerPage;
            // Check if we need to loop back to the first items
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
        // Function to move to the previous set of items
        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            } else {
                this.currentIndex = this.products.length - 1;
            }
        },
        // Function to move to the next set of items
        next() {
            if (this.currentIndex < this.products.length) {
                this.currentIndex++;
            } else {
                this.currentIndex = 0;
            }
        },
    },
};
</script>

<style scoped>

</style>
