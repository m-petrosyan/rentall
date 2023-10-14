<template>
    <MainTopMenu/>
    <CartButtonComponent :cart="cart"/>
    <main class="max-w-screen-lg w-full mx-auto mt-20 mb-36 s:px-10 md:px-16 lg:px-0">
        <router-view :setStorage="setStorage" :cart="cart"/>
    </main>
    <Footer/>
</template>
<script>
import CartButtonComponent from "@/components/elements/CartButtonComponent.vue";
import Footer from "@/components/parth/Footer.vue";
import MainTopMenu from "@/components/menu/MainTopMenu.vue";

export default {
    components: {Footer, CartButtonComponent, MainTopMenu},
    props: {
        setStorage: Function,
        cart: Object
    }
}
</script>

