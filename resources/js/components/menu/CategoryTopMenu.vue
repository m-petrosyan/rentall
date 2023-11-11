<template>
    <menu>
        <nav class="border-gray-200 dark:border-gray-700 mt-5 s:block lg:hidden">
            <div class="max-w-screen-xl flex flex-wrap items-center mx-auto p-4 w-full  justify-end">
                <button data-collapse-toggle="navbar-hamburger" type="button" @click="hide = !hide"
                        class="inline-flex  p-2 w-10 h-10 ml-3 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-hamburger" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                <div class="w-full" id="navbar-hamburger" :class="{'hidden': hide}">
                    <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        <li class="w-full  text-center">
                            <button
                                class="w-full block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                @click="setCategory(null)">All
                            </button>
                        </li>
                        <li v-for="item in categories.data" :key="item.id" class="w-full  text-center">
                            <button
                                class="w-full block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                aria-current="page" @click="setCategory(item.id)">
                                {{ item.title }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="gap-x-5 justify-center mt-10  s:hidden lg:flex flex-wrap">
            <li>
                <button class="font-semibold" @click="setCategory(null)">All</button>
            </li>
            <li v-for="category in categories.data" :key="category.id">
                <button class="font-semibold" @click="setCategory(category.id)">{{
                        category.title
                    }}
                </button>
            </li>
        </ul>
    </menu>
</template>

<script>
export default {
    props: {
        categories: Array,
        category: Number,
        page: Number,
        search: String,
    },
    methods: {
        setCategory(id) {
            this.$emit('update:search', null)
            this.$emit('update:category', id)
            this.$emit('update:page', 1)
            this.$router.push({name: 'home', params: {page: 1}})
        }
    },
    data() {
        return {
            hide: true
        }
    }
}
</script>

<style scoped>

</style>
