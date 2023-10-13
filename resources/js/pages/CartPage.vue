<template>
    <div class="container max-w-2xl mx-auto">
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
                <h2 class="flex flex-col gap-y-10  items-end w-1/6 text-right">
                    {{ item.price * item.count }} AMD
                    <button class="opacity-50" @click="deleteItem(item.dataId)">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon icon-tabler icon-tabler-square-rounded-minus" width="30" height="30"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 12h6"/>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"/>
                        </svg>
                    </button>
                </h2>
            </div>
            <h2 class="flex justify-end font-bold">Total price: {{ totalPrice }} AMD</h2>
        </div>
        <form>
            <div class="space-y-12 mt-16">
                <div class="pb-12">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Full
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
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
                                <textarea id="about" name="about" rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button class="cart">Order</button>
            </div>
        </form>
    </div>
</template>

<script>
import CountButton from "@/components/elements/CountButton.vue";
import moment from 'moment'

export default {
    components: {CountButton},
    props: {
        cart: Object
    },
    data() {
        return {
            moment: moment,
            minDaysCount: 1,
            range: {},
            mode: 'date',
            selectedColor: 'orange',
            selectedDate: {},
        }
    },
    methods: {
        plus(item) {
            this.cart.push(item)
        },
        minus(index) {
            this.cart.splice(index, 1)
        },
        dayClick(e) {
            console.log(e)
        },
        deleteItem(dataId) {
            this.cartData = this.cartData.filter(item => item.dataId !== dataId)
        },
        order() {
            // moment(selectedDate.start).format('YYYY-MM-DD')
        }
    },
    computed: {
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
