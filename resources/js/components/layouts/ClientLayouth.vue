<template>
    <MainTopMenu/>
    <CartButtonComponent :cart="cart" v-if="cart.length"/>
    <main class="max-w-screen-lg w-full mx-auto mb-36 s:px-10 md:px-16 lg:px-0"
          :class="{'mt-10' : !route}">
        <router-view :setStorage="setStorage" :cart="cart"/>
    </main>
    <Footer/>
</template>
<script>
import CartButtonComponent from "@/components/elements/CartButtonComponent.vue";
import Footer from "@/components/footer/Footer.vue";
import MainTopMenu from "@/components/menu/MainTopMenu.vue";

export default {
    components: {Footer, CartButtonComponent, MainTopMenu},
    props: {
        setStorage: Function,
        cart: Object
    },
    computed: {
        route() {
            return this.$route.name === 'home'
        }
    }
}
</script>

