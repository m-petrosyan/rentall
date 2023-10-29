<template>
    <div class="footer w-full bg-dark text-white py-16 s:px-10 md:px-16 lg:px-0">
        <div
            class="w-full md:h-60 flex s:flex-col lg:flex-row s:gap-y-10 justify-between gap-x-5 max-w-screen-lg mx-auto ">
            <div class="s:hidden sm:block sm:w-5/6">
                <GoogleMap
                    class="w-full lg:h-full s:h-48"
                    :api-key="options.apiKey"
                    :styles="[{theme: options.markers.theme}]"
                    mapTypeId="terrain"
                    :center="options.markers.position"
                    :zoom="options.markers.position.zoom">
                    <CustomMarker :options="{ position: options.markers.position, anchorPoint: 'BOTTOM_CENTER' }">
                        <div style="text-align: center">
                            <img :src="options.markers.icon" width="64" height="64" style="margin-top: 8px" alt=""/>
                        </div>
                    </CustomMarker>
                </GoogleMap>
            </div>
            <div>
                <h3>Contacts</h3>
                <div class="flex flex-col gap-y-3 mt-6">
                    <div class="flex items-center gap-x-2">
                        <Mapicon/>
                        <a href="https://maps.app.goo.gl/a399tq19inHdRSFi8" class="text-sm" target="_blank">Yervand
                            Kochar Street
                            24/4</a>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <PhoneIcon/>
                        <a href="tel:+37441744489" class="text-sm">041744489</a>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <PhoneIcon/>
                        <a href="tel:+37494445545" class="text-sm">094445545</a>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <InstagramIcon/>
                        <a href="https://www.instagram.com/rentprocinema_arm/" target="_blank" class="text-sm">rentprocinema_arm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {CustomMarker, GoogleMap} from "vue3-google-map";
import icon from "../../../assets/images/loc.svg"
import Mapicon from "@/components/icons/Mapicon.vue";
import PhoneIcon from "@/components/icons/PhoneIcon.vue";
import InstagramIcon from "@/components/icons/InstagramIcon.vue";

export default {
    data() {
        return {
            options: {
                apiKey: 'AIzaSyDKiK1LFn6qShJa2j3Y5dKCfDu1JIVrrAs',
                markers:
                    {
                        theme: 'dark',
                        icon: icon,
                        position: {
                            lat: 40.16927161429312,
                            lng: 44.51461054739329,
                            zoom: 17.25
                        },
                    },
            },

        }
    },
    components: {InstagramIcon, PhoneIcon, Mapicon, GoogleMap, CustomMarker},
}

</script>

<style scoped>

</style>
