<template>
    <menu class="h-12 flex items-center justify-center bg-black py-2">
        <button @click="goToHome">
            <img :src="logo" alt="logo" class="h-10">
        </button>
    </menu>
</template>

<script>
import logo from '../../../assets/images/logo.png'

export default {
    data() {
        return {
            logo: logo
        }
    },
    methods: {
        goToHome() {
            this.$router.push({name: 'home', params: {page: 1}})
        }
    }
}
</script>
