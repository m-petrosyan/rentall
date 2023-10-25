<template>
    <section class="bg-dark">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-dark-grey rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <ErrorMessages :error="v$" :serverError="error"/>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="signIn">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-white">Your
                                email</label>
                            <input v-model="form.username" type="email" name="email" id="email"
                                   class="bg-dark-input text-white sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                            <input v-model="form.password" type="password" name="password" id="password" placeholder=""
                                   class="bg-dark-input text-white sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required="">
                        </div>
                        <button type="submit" :disabled="loading"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {email, minLength, required} from '@vuelidate/validators'
import useVuelidate from "@vuelidate/core";
import ErrorMessages from "@/components/elements/ErrorMessages.vue";
import Preloader from "@/pages/other/Preloader.vue";

export default {
    components: {ErrorMessages, Preloader},
    data() {
        return {
            loading: false,
            form: {
                username: '',
                password: ''
            }
        }
    },
    setup() {
        return {v$: useVuelidate()}
    },
    validations() {
        return {
            form: {
                username: {required, email},
                password: {required, minLength: minLength(8)},
            }
        }
    },
    methods: {
        signIn() {
            this.v$.$touch()
            if (!this.v$.$error) {
                this.loading = true
                this.$store.dispatch('signIn', this.form)
                    .then(() => {
                        this.$store.dispatch('auth').then(() => {
                            this.$router.push({name: 'dashboard'})
                        })
                    })
                    .finally(() => this.loading = false)
            }
        }
    },
    computed: {
        error() {
            return this.$store.getters.getAuthError
        }
    },
}
</script>

<style scoped>
</style>
