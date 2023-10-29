<template>
    <section class="p-3 sm:p-5 h-screen">
        <h2>Brand</h2>
        <div v-if="brands" class="mx-auto mt-10 max-w-screen-2xl">
            <div class="flex flex-col gap-y-10 justify-between bg-white relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs ppercase">
                        <tr>
                            <th scope="col" class="p-4">Brand</th>
                            <th scope="col" class="p-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="brand in brands.data" :key="brand.id"
                            class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center mr-3">
                                    {{ brand.title }}
                                </div>
                            </th>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center space-x-4">
                                    <router-link :to="{name:'db-productupdate',params:{id: brand.id}}" type="button"
                                                 class="py-2 px-3 text-center focus:outline-none text-white bg-grey-blue rounded">
                                        Edit
                                    </router-link>
                                    <button type="button"
                                            class="py-2 px-3 text-center focus:outline-none text-white bg-red-600">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <PaginationCreateComponent
                    :meta="brands.meta"
                    :page="this.paginate.page"
                    :button="true"
                    :route="'db-productcreate'"
                />
            </div>
        </div>
        <Preloader v-else/>
    </section>
    <div id="delete-modal" tabindex="-1"
         class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full h-auto max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="delete-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                         stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete this product?</h3>
                    <button data-modal-toggle="delete-modal" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-toggle="delete-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import PaginationCreateComponent from "@/components/elements/PaginationCreateComponent.vue";
import paginateMixin from "@/mixins/paginateMixin";
import Preloader from "@/components/elements/Preloader.vue";


export default {
    components: {Preloader, PaginationCreateComponent},
    mixins: [paginateMixin],
    data() {
        return {
            loading: true,
            paginate: {
                limit: 10,
                page: +this.$route.params.page
            }
        }
    },
    created() {
        this.getData()
    },
    computed: {
        ...mapGetters(['brands'])
    },
    methods: {
        ...mapActions(['getBrands']),
        getData() {
            this.getBrands(this.paginate)
                .then(() => this.loading = false)
        }
    },
    watch: {
        paginate: {
            handler() {
                this.loading = true
                this.getBrands(this.paginate).then(() => this.loading = false)
            },
            deep: true
        },
    }
}
</script>

<style scoped>

</style>
