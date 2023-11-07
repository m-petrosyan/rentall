<template>
    <div class="container max-w-2xl mx-auto">
        <div v-if="!ordered">
            <h3 class="font-bold">Your order</h3>
            <hr class="mt-5">
            <div class="flex flex-col gap-y-5 mt-5">
                <div class="flex justify-between s:flex-col sm:flex-row" v-for="(item,index) in cartData"
                     :key="item.id">
                    <router-link :to="{name: 'product', params: {id: item.id}}"
                                 class="flex gap-x-5 s:gap-y-5 sm:gap-y-0 sm:w-4/6 s:flex-col sm:flex-row s:w-full s:text-center sm:text-left">
                        <div
                            class="s:h-48  md:h-40 bg-contain bg-no-repeat sm:flex-row s:w-full sm:w-5/12 s:text-center sm:text-left s:bg-center sm:bg-left"
                            :style="{backgroundImage: `url(${item.image})`}"></div>
                        <div class="w-auto s:mx-auto sm:mx-0">
                            <h3 class="title font-bold">{{ item.title }}</h3>
                            <div class="" v-for="el in item.options" :key="item.id">
                                <div class="flex justify-between">
                                    <p class="flex">{{ el.title }} </p>
                                </div>
                            </div>
                        </div>
                    </router-link>
                    <div class="w-1/6 s:mx-auto s:mt-2 sm:mt-0">
                        <CountButton v-model:count="item.count" :plus="()=>plus(item)" :minus="()=>minus(index)"/>
                    </div>
                    <h2 class="flex flex-col w-1/6 s:text-center sm:text-right s:mx-auto s:mt-5 sm:mt-0">
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
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 s:grid-cols-1 lg:grid-cols-6">
                            <div class="s:col-span-full lg:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">First
                                    name</label>
                                <div class="mt-2">
                                    <input v-model="data.first_name" type="text" name="first-name" id="last-name"
                                           autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="s:col-span-full lg:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last
                                    name</label>
                                <div class="mt-2">
                                    <input v-model="data.last_name" type="text" name="last-name" id="last-name"
                                           autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="s:col-span-full lg:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input v-model="data.email" id="email" name="email" type="email"
                                           autocomplete="email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="s:col-span-full lg:col-span-3">
                                <label for="tel" class="block text-sm font-medium leading-6 text-gray-900">
                                    Phone number</label>
                                <div class="mt-2">
                                    <input v-model="data.tel" type="tel" name="tel" id="tel"
                                           autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="s:col-span-full">
                                <VDatePicker
                                    :expanded="true"
                                    :first-day-of-week="2"
                                    :color="selectedColor"
                                    @dayclick='dayClick'
                                    v-model.range="selectedDate"
                                />
                            </div>
                            <div class="s:col-span-full">
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
                    <h3 class="text-lg font-medium">Thank you, your order has been accepted</h3>
                </div>
                <div class="mt-2 mb-4 text-sm">
                    We will contact you soon
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
            first_name: {required, minLength: minLength(3)},
            last_name: {required, minLength: minLength(3)},
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
                this.createRent(newData).then(() => {

                    this.setStorage('cart', [], true)

                    this.ordered = true
                })
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
