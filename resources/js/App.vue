<template>
    <router-view :setStorage="setStorage" :cart="cart"/>
</template>

<script>
import storageMixin from "@/mixins/storageMixin";

export default {
    mixins: [storageMixin]
}
</script>


<style scoped>


</style>
