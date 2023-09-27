<template>
    <header>
        header sda
    </header>
    <CardButtonComponent/>
    <main class="max-w-screen-lg mx-auto s:px-10 md:px-16 lg:px-0">
        <router-view/>
    </main>
</template>

<script>

import {defineComponent} from "vue";
import CardButtonComponent from "@/components/card/CardButtonComponent.vue";

export default defineComponent({
    components: {CardButtonComponent}
})
</script>


<style scoped>
header {
    background-color: red;
}

</style>
