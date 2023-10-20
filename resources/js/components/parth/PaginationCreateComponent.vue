<template>
    <div class="flex justify-between items-center">
        <div>
            <button type="button"
                    class="py-2 px-3 text-center focus:outline-none text-white bg-blue-500">
                Create
            </button>
        </div>
        <nav
            class="flex flex-col md:flex-row gap-x-5 justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
            aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Showing
                            <span class="font-semibold text-gray-900 dark:text-white">{{ meta.per_page }}</span>
                            of
                            <span class="font-semibold text-gray-900 dark:text-white">{{ meta.total }}</span>
                        </span>
            <ul class="inline-flex items-stretch -space-x-px">
                <li v-if="meta.current_page > 1">
                    <button @click="changePage(meta.current_page - 1)" href="#"
                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </li>
                <li v-for="pageNumber in paginationNumbers" :key="pageNumber"
                    :class="{ active: pageNumber === meta.current_page }">
                    <button @click="changePage(pageNumber)"
                            :class="{'z-10   text-primary-600  bg-primary-50  border-primary-300   hover:bg-primary-100' : meta.current_page === pageNumber}"
                            class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        {{ pageNumber }}
                    </button>
                </li>
                <li v-if="meta.current_page < meta.last_page">
                    <button @click="changePage(meta.current_page + 1)"
                            class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        meta: Object,
        page: Number
    },
    methods: {
        changePage(page) {
            this.$router.push({ name: 'db-product',params:{page: page}})
        }
    },
    computed: {
        paginationNumbers() {
            const start = Math.max(this.meta.current_page - 2, 1);
            const end = Math.min(start + 4, this.meta.last_page);

            const paginationNumbers = [];
            for (let i = start; i <= end; i++) {
                paginationNumbers.push(i);
            }

            return paginationNumbers;
        },
    }
}
</script>


<style scoped>

</style>
