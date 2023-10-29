<template>
    <section>
        <div class="relative p-4 w-full" v-if="product && options && !loading">
            <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div
                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Product</h3>
                </div>
                <ErrorMessages :error="v$" :serverError="productError?.message"/>
                <form @submit.prevent="createProductQuery">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Title
                            </label>
                            <input type="text" name="name" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Type product name" required="" v-model="product.data.title ">
                        </div>
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="category"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select v-model="product.data.category.id"
                                        id="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option v-for="category in options.data.categories" :key="category.id"
                                            :value="category.id">
                                        {{ category.title }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="brand"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                <select v-model="product.data.brand.id"
                                        id="brand"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option v-for="brand in  options.data.brands" :key="brand.id" :value="brand.id">
                                        {{ brand.title }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Price
                            </label>
                            <input type="number" name="price" id="price" min="0"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="" required="" v-model="product.data.price">
                        </div>
                        <div>
                            <label for="kits"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kits</label>
                            <v-select
                                class="p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                multiple="true" required
                                :options="options.data.kits" label="title"
                                v-model="product.data.kits"/>
                        </div>
                        <div>
                            <label for="similar_products"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Similar products</label>
                            <v-select
                                class="p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                multiple="true"
                                :options="options.data.similars" label="title"
                                v-model="product.data.similars"/>
                        </div>
                        <div class="mb-4 space-y-4 sm:flex sm:space-y-0">
                            <div class="mr-4">
                                <label for="inline-checkbox"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slider</label>
                                <div id="inline-checkbox" class="mt-square-garden ">
                                    <input id="1" type="checkbox" v-model="product.data.slider"
                                           :false-value="0"
                                           :true-value="1"/>
                                    <label for="1" class="border border-gray-300  rounded-lg overflow-hidden"></label>
                                </div>
                            </div>
                        </div>
                        <div class="img-content">
                            <span
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</span>
                            <div class="flex justify-center items-center w-full bg-contain bg-center bg-no-repeat"
                                 :style="{backgroundImage : `url(${main_image_preview})`}">
                                <label for="main_image"
                                       class="flex flex-col justify-center items-center w-full h-slider  rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex-col justify-center items-center pt-5 pb-6 hidden hover:flex">
                                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                                             stroke="currentColor" viewbox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Click to upload</span>
                                            or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (MAX.
                                            1900x500)</p>
                                    </div>
                                    <input id="main_image" type="file" class="hidden"
                                           @change="changePicture">
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label><textarea
                            id="description" rows="4"
                            class="h-full block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Write product description here"
                            v-model="product.data.description"></textarea>
                        </div>
                    </div>

                    <div class="mb-4 img-content">
                        <span class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</span>
                        <div class="flex justify-center items-center w-full cover bg-center bg-no-repeat"
                             :style="{backgroundImage : `url(${slider_image_preview})`}">
                            <label for="slider_image"
                                   class="flex flex-col justify-center items-center w-full h-slider  rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex-col justify-center items-center pt-5 pb-6 group-hover:flex hidden">
                                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                                         stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (MAX.
                                        1900x500)</p>
                                </div>
                                <input id="slider_image" type="file" class="hidden"
                                       @change="changePicture">
                            </label>
                        </div>
                    </div>
                    <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                        <button type="submit"
                                class="w-full sm:w-auto justify-center text-white inline-flex bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Add product
                        </button>
                        <button data-modal-toggle="createProductModal" type="button"
                                class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <Preloader v-else/>
    </section>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Preloader from "@/components/elements/Preloader.vue";
import ErrorMessages from "@/components/elements/ErrorMessages.vue";
import {minLength, numeric, required} from "@vuelidate/validators";

import useVuelidate from "@vuelidate/core";

export default {
    components: {ErrorMessages, Preloader},
    data() {
        return {
            main_image_preview: null,
            slider_image_preview: null,
            loading: false,
            newData: null,
            validateData: {}
        }
    },
    setup() {
        return {v$: useVuelidate()}
    },
    validations: {
        validateData: {
            title: {required},
            price: {required, numeric},
            description: {required, minLength: minLength(10)},
        }
    },
    created() {
        this.getData()
    },
    methods: {
        ...mapActions(['editProduct', 'optionsProduct', 'createProduct']),
        getData() {
            if (this.$route.params.id) {
                this.editProduct(this.$route.params.id)
            } else {
                this.product = {}
            }
            this.optionsProduct();
            this.loading = false
        },
        changePicture(file) {
            this[file.target.id + '_preview'] = URL.createObjectURL(file.target.files[0])
            this[file.target.id] = file.target.files[0]
        },
        createProductQuery() {
            this.v$.$touch()
            this.validateData = this.product.data
            if (!this.v$.$error && !this.selectedDateValidation) {
                const data = new FormData
                if (this.main_image) data.append('main_image', this.main_image)
                if (this.slider_image) data.append('slider_image', this.slider_image)


                data.append('title', this.product.data.title)
                data.append('description', this.product.data.description)
                data.append('price', this.product.data.price)
                data.append('slider', this.product.data.slider)
                data.append('category_id', this.product.data.category.id)
                data.append('brand_id', this.product.data.brand.id)


                for (const kit of this.product.data.kits) {
                    data.append("kits[]", kit.id);
                }

                for (const similar of this.product.data.similars) {
                    data.append("similars[]", similar.id);
                }

                this.createProduct(data).then(() => this.$router.push({name: 'db-product', params: {page: 1}}))
            }
        }
    },
    computed: {
        ...mapGetters(['options']),
        product() {
            return this.$route.params.id ? this.$store.getters.product : {
                data: {
                    category: {},
                    brand: {},
                    slider: 0
                }
            }
        },
        productError() {
            return this.$store.getters.getProductError
        }
    }
}
</script>


<style scoped>
.img-content label:hover div {
    display: flex;
}
</style>
