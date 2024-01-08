<template>
    <div v-if="show" :class="{show:alert}" ref="message">
        <div class="messages">
            <div
                class="border lowercase capitalize border-red-400 font-bold rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p v-for="error of error.$errors" :key="error.$uid">
                    <span>
                      <span>{{ error.$property }}</span>
                      <span>{{ ' ' + error.$message.replace("This field", "") }}</span>
                    </span>
                </p>

                <p v-if="serverError">
                    <span>
                        {{ serverError }}
                    </span>
                </p>
                <p v-if="customValidation">
                    <span>
                        {{ customValidation }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "ErrorMessages",
    props: {
        error: Object,
        serverError: String,
        customValidation: Function
    },
    computed: {
        show() {
            return (this.error?.$dirty && (this.error.$error || this.customValidation)) || this.serverError;
        }
    }
}
</script>

<style scoped>

</style>
