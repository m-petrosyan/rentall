<template>
    {{ product }}
</template>

<script>
export default {
    computed: {
        product() {
            return this.$store.getters.getProduct(this.$route.params.id)
        }
    },
}

</script>


<style scoped>

</style>
