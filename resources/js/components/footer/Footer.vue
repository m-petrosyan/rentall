<template>
    <div class="footer w-full bg-dark text-white py-16 s:px-10 md:px-16 lg:px-0">

        <div
            class="w-full  flex s:flex-col lg:flex-row s:gap-y-10 justify-between gap-x-5 max-w-screen-lg mx-auto ">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3048.7947167703314!2d44.51463199999999!3d40.1691241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abc5f01bf317b%3A0x85f721fcdfce5680!2s24%20Yervand%20Kochar%20St%2C%20Yerevan!5e0!3m2!1sru!2sam!4v1698600198896!5m2!1sru!2sam"
                width="600" class="h-full w-full s:hidden sm:block sm:w-5/6" style="border:0;" allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                        <a href="https://www.instagram.com/rentall_am/" target="_blank" class="text-sm">@rentall_am</a>
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
