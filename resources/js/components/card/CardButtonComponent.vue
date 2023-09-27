<template>
    <a class="fixed h-16 w-16 top-10 right-10 rounded-full p-3 ring-2 ring-grey-500 ring-offset-2 " href="">
        <img class="h-full w-full" :src="card" alt="">
        <p class="absolute bottom-0 right-0 bg-orange text-white w-6 h-6 text-center leading-6 rounded-full">1</p>
    </a>
</template>

<script>
import card from "../../../assets/images/card.svg";

export default {
    data() {
        return {
            card: card
        }
    }
}
</script>

<style scoped>

</style>
