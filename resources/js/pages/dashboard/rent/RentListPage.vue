<template>
    <section class="p-3 sm:p-5 h-screen">
        <h2>Rents</h2>
        <div v-if="rents && !loading" class="mx-auto mt-10 max-w-screen-2xl">
            <div class="flex flex-col gap-y-10 justify-between bg-white relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs ppercase">
                        <tr>
                            <th scope="col" class="p-4">Products</th>
                            <th scope="col" class="p-4">First name</th>
                            <th scope="col" class="p-4">Last name</th>
                            <th scope="col" class="p-4">Tel</th>
                            <th scope="col" class="p-4">Email</th>
                            <th scope="col" class="p-4">Comment</th>
                            <th scope="col" class="p-4">Total price</th>
                        </tr>
                        </thead>
                        <tbody>
						{{rent}}
                        <tr v-for="rent in rents.data" :key="rent.id"
                            class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div v-for="product in rent.products">
                                    {{ product.title }}
                                </div>
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ rent.first_name }}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{ rent.last_name}}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{ rent.tel}}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{ rent.email}}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{ rent.comment}}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{ rent.total_price}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
<!--                <PaginationCreateComponent-->
<!--                    :meta="rents.meta"-->
<!--                    :page="this.paginate.page"-->
<!--                    :button="true"-->
<!--                />-->
            </div>
        </div>
        <Preloader v-else/>
    </section>
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
            daleteId: null,
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
        ...mapGetters(['rents'])
    },
    methods: {
        ...mapActions(['getRents']),
        getData() {
            this.loading = true
            return this.getRents(this.paginate)
                .then(() => this.loading = false)
        },
    },
    watch: {
        paginate: {
            handler() {
                this.loading = true
                this.getRents(this.paginate).then(() => this.loading = false)
            },
            deep: true
        },
    }
}
</script>

<style scoped>

</style>
