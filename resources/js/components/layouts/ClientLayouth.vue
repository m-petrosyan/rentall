<template>
    <div class="flex flex-col justify-between min-h-screen">
        <MainTopMenu/>
        <CartButtonComponent :cart="cart" v-if="cart.length"/>
        <main class="max-w-screen-lg w-full mx-auto mb-20 s:px-10 md:px-16 lg:px-0"
              :class="{'mt-10' : !route}">
            <router-view :setStorage="setStorage" :cart="cart"/>
        </main>
        <Footer/>
    </div>

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
            return ['home', 'home-paginate'].includes(this.$route.name)
        }
    }
}
</script>

