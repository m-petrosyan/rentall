<template>
    <menu class="h-12 flex items-center justify-center bg-black py-2">
        <button @click="goToHome">
            <img src="/logo.webp" alt="logo" class="h-10">
        </button>
    </menu>
</template>

<script>
export default {
    methods: {
        goToHome() {
            this.$router.push({name: 'home', params: {page: 1}})
        }
    }
}
</script>
