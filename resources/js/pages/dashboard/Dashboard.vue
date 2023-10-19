<template>
    <div class="flex min-h-screen">
        <DashboardNavbar class="w-2/12"/>
        <div class="w-10/12">
            <router-view/>
        </div>
    </div>
</template>

<script setup>

import DashboardNavbar from "@/components/menu/DashboardNavbar.vue";
</script>


<style scoped>

</style>
