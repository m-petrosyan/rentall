<template>
    <button @click="next ? nextSlide() : prevSlide()">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24"
             height="24" :class="{'rotate-180 transform-gpu':!next}"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
             stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 6l6 6l-6 6"></path>
        </svg>
    </button>
</template>

<script>
export default {
    props: {
        index: Number,
        length: Number,
        next: Boolean
    },
    methods: {
        prevSlide() {
            let count;
            if (this.index > 0) {
                count = this.index - 1;
            } else {
                count = this.length - 1;
            }
            this.$emit('update:index', count)
        },
        nextSlide() {
            let count;
            if (this.index < this.length) {
                count = this.index + 1;
            } else {
                count = 0;
            }
            this.$emit('update:index', count)
        },
    }
}

</script>

<style scoped>

</style>
