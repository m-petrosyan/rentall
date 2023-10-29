<template>
    <menu class="h-12 flex items-center justify-center bg-black py-2">
        <router-link :to="{name:'home'}">
            <img :src="logo" alt="logo" class="h-10">
        </router-link>
    </menu>
</template>

<script>
import logo from '../../../assets/images/logo.png'

export default {
    data() {
        return {
            logo: logo
        }
    }
}
</script>
