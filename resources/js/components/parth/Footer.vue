<template>
    <div class="footer w-full bg-dark text-white py-16">
        <div class="w-full h-60 flex justify-between gap-x-5 max-w-screen-lg mx-auto ">
            <div>
                google map
            </div>
            <div>
                <h3>Contacts</h3>
                <div class="flex flex-col gap-y-3 mt-6">
                    <div class="flex items-center gap-x-2">
                        <Mapicon/>
                        <p>Yervand Kochar Street 24/4</p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <PhoneIcon/>
                        <p>041744489</p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <PhoneIcon/>
                        <p>094445545</p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <InstagramIcon/>
                        <a href="https://www.instagram.com/rentprocinema_arm/" target="_blank">rentprocinema_arm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import InstagramIcon from "@/components/icons/InstagramIcon.vue";
import PhoneIcon from "@/components/icons/PhoneIcon.vue";
import Mapicon from "@/components/icons/Mapicon.vue";
</script>

<style scoped>
.footer {
    margin-block-start: auto;
}
</style>
