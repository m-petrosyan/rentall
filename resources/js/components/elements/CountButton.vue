<template>
    <div class="flex justify-between items-center border-gray rounded-md w-24" :class="plus ? 'cart' : 'border'">
        <button class="px-2" @click="changeCount(false)">-
        </button>
        <span>{{ count }}</span>
        <button class="px-2" @click="changeCount(true)">+</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            minCount: this.delete ? 0 : 1
        }
    },
    props: {
        plus: Function,
        minus: Function,
        count: Number,
        delete: Boolean
    },
    methods: {
        changeCount(add) {
            let count = this.count
            if (add) {
                if (this.plus) {
                    this.plus()
                    return
                }
                count++
            } else if (count > this.minCount) {
                if (this.minus) {
                    this.minus()
                    return
                }
                count--
            }

            this.$emit('update:count', count)
        }
    }
}
</script>
