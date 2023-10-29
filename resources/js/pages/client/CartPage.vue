<template>
    <div class="container max-w-2xl mx-auto">
        <div v-if="!ordered">
            <h3 class="font-bold">Your order</h3>
            <hr class="mt-5">
            <div class="flex flex-col gap-y-5 mt-5">
                <div class="flex justify-between " v-for="(item,index) in cartData" :key="item.id">
                    <router-link :to="{name: 'product', params: {id: item.id}}" class="flex gap-x-5 w-4/6">
                        <div class="w-5/12 s:h-32  md:h-40 bg-contain bg-no-repeat"
                             :style="{backgroundImage: `url(${item.image})`}"></div>
                        <div class="w-auto">
                            <h3 class="title font-bold">{{ item.title }}</h3>
                            <div class="" v-for="el in item.options" :key="item.id">
                                <div class="flex justify-between">
                                    <p class="flex">{{ el.title }} </p>
                                </div>
                            </div>
                        </div>
                    </router-link>
                    <div class="w-1/6">
                        <CountButton v-model:count="item.count" :plus="()=>plus(item)" :minus="()=>minus(index)"/>
                    </div>
                    <h2 class="flex flex-col w-1/6 text-right">
                        {{ item.price * item.count }} AMD
                    </h2>
                </div>
                <h2 class="flex justify-end font-bold">Total price: {{ totalPrice }} AMD</h2>
            </div>
            <ErrorMessages :error="v$" :serverError="getOrderError?.message"
                           :customValidation="selectedDateValidation"/>
            <form class="space-y-4 md:space-y-6" @submit.prevent="order">
                <div class="space-y-12 mt-16">
                    <div class="pb-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Full
                                    name</label>
                                <div class="mt-2">
                                    <input v-model="data.full_name" type="text" name="last-name" id="last-name"
                                           autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input v-model="data.email" id="email" name="email" type="email"
                                           autocomplete="email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">
                                    Phone number</label>
                                <div class="mt-2">
                                    <input v-model="data.tel" type="tel" name="last-name" id="last-name"
                                           autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <VDatePicker
                                    :expanded="true"
                                    :first-day-of-week="2"
                                    :color="selectedColor"
                                    @dayclick='dayClick'
                                    v-model.range="selectedDate"
                                />
                            </div>
                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Additional
                                    comment</label>
                                <div class="mt-2">
                                <textarea v-model="data.comment" id="about" name="about" rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button class="cart" type="submit">Order</button>
                </div>
            </form>
        </div>
        <div v-else>
            <div id="alert-additional-content-3"
                 class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                 role="alert">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium">Thank you, your request has been sent</h3>
                </div>
                <div class="mt-2 mb-4 text-sm">
                    More info about this info success goes here. This example text is going to run a bit longer so that
                    you can see how spacing within an alert works with this kind of content.
                </div>
                <div class="flex">
                    <button type="button"
                            class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 20 14">
                            <path
                                d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                        </svg>
                        View more
                    </button>
                    <button type="button"
                            class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-green-600 dark:border-green-600 dark:text-green-400 dark:hover:text-white dark:focus:ring-green-800"
                            data-dismiss-target="#alert-additional-content-3" aria-label="Close">
                        Dismiss
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CountButton from "@/components/elements/CountButton.vue";
import moment from 'moment'
import {mapActions, mapGetters} from "vuex";
import ErrorMessages from "@/components/elements/ErrorMessages.vue";
import {email, maxLength, minLength, required} from "@vuelidate/validators";

import useVuelidate from "@vuelidate/core";

export default {
    components: {ErrorMessages, CountButton},
    props: {
        cart: Object,
        setStorage: Function
    },
    data() {
        return {
            ordered: false,
            moment: moment,
            minDaysCount: 1,
            range: {},
            mode: 'date',
            selectedColor: 'orange',
            selectedDate: {},
            data: {},
            products: []
        }
    },
    setup() {
        return {v$: useVuelidate()}
    },
    validations: {
        data: {
            full_name: {required},
            email: {required, email},
            tel: {required, minLength: minLength(9), maxLength: maxLength(16)},
        },
    },
    methods: {
        ...mapActions(['createRent']),
        plus(item) {
            this.cart.push(item)
            this.setStorage('cart', this.cart, true)
        },
        minus(index) {
            this.cart.splice(index, 1)
            this.setStorage('cart', this.cart, true)
        },
        dayClick(e) {
            console.log(e)
        },
        order() {
            this.v$.$touch()
            if (!this.v$.$error && !this.selectedDateValidation) {
                const cartProducts = this.cart.flatMap(item => [item.id, ...item.options.map(option => option.id)]);
                const newData = {
                    start_date: this.selectedDate.start ? moment(this.selectedDate.start).format('YYYY-MM-DD') : null,
                    end_date: this.selectedDate.end ? moment(this.selectedDate.end).format('YYYY-MM-DD') : null,
                    ...this.data,
                    products: cartProducts
                }
                console.log(newData)
                this.createRent(newData).then(() => this.ordered = true)
            }
        }
    },
    computed: {
        ...mapGetters(['getOrderError']),
        selectedDateValidation() {
            return !(this.selectedDate.start instanceof Date && !isNaN(this.selectedDate.start)) ? 'Select reservation date' : false;
        },
        totalPrice() {
            return this.cartData.reduce((acc, item) => acc + item.price * item.count, 0) * this.getDaysCount;
        },
        cartData() {
            const mergedData = {};
            this.cart.forEach((item, index) => {
                const key = JSON.stringify({id: item.id, options: item.options});
                if (!mergedData[key]) {
                    mergedData[key] = {...item, count: 1, dataId: index,};
                } else {
                    mergedData[key] = {
                        ...mergedData[key],
                        dataId: index,
                        price: item.price,
                        count: mergedData[key].count + 1,
                    };
                }
            });
            return Object.values(mergedData);
        },
        getDaysCount() {
            if (this.selectedDate.start && this.selectedDate.end) {
                const start = new Date(this.selectedDate.start);
                const end = new Date(this.selectedDate.end);
                const timeDifference = end.getTime() - start.getTime();
                return Math.ceil(timeDifference / (1000 * 3600 * 24)) + this.minDaysCount;
            }
            return this.minDaysCount;
        },
    },
}
</script>

<style>

</style>
