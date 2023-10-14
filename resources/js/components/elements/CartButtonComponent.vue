<template>
    <router-link :to="{name:'cart'}" class="fixed h-16 w-16 top-16 right-10  p-3" href="">
        <div ref="icon" class="h-full w-full bg-contain"/>
        <p class="absolute bottom-0 right-0 bg-orange-dark text-white w-6 h-6 text-center leading-6 rounded-full">
            {{ cart.length }}
        </p>
    </router-link>
</template>

<script>


import cartAnimationStatic from "../../../assets/images/card-animation.png";
import cartAnimation from "../../../assets/images/card-animation.gif";

export default {
    props: {
        cart: Number
    },
    data() {
        return {
            cartAnimationStatic: cartAnimationStatic,
            cartAnimation: cartAnimation
        }
    },
    mounted() {
        this.animationPause()
    },
    methods: {
        animationPause() {
            this.$refs.icon.style.backgroundImage = `url(${this.cartAnimationStatic})`
            this.$refs.icon.classList.remove('animate')
        },
        animationPlay() {
            this.$refs.icon.style.backgroundImage = `url(${this.cartAnimation})`

            this.$refs.icon.classList.add('animate')
            setTimeout(() => this.animationPause(), 1000)
        }
    },
    watch: {
        cart() {
            this.animationPlay()
        }
    }
}
</script>

<style scoped>
.animate {
    stroke: #000;
    transition: all .3s;
    transform: scale(1);
    animation: animate .5s linear;
}

@keyframes animate {
    0% {
        stroke: #000;
        transform: rotate(0deg);
    }

    60% {
        stroke: #b66e25;
    //transform: rotate(60deg); transform: scale(1.3);
    }


    100% {
        stroke: #000;
        transform: scale(1);
    //transform: rotate(0deg);
    }
}
</style>
