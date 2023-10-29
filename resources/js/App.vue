<template>
    <router-view class="min:h-screen" :setStorage="setStorage" :cart="cart"/>
</template>

<script>
import storageMixin from "@/mixins/storageMixin";


export default {
    mixins: [storageMixin],
    mounted() {
        if (sessionStorage.getItem('token')) {
            this.$store.dispatch('auth').catch(() => this.$router.push({name: 'login'}))
        }
    },
}
</script>
