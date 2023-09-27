<template>
    <div class="flex justify-between items-center border-gray rounded-md border w-24 px-2">
        <button @click="changeCount(false)">-</button>
        <span>{{ count }}</span>
        <button @click="changeCount(true)">+</button>
    </div>
</template>

<script>
export default {
    props: {
        count: Number
    },
    methods: {
        changeCount(add) {
            let count = this.count
            if (add) {
                count++
            } else if (count > 1) {
                count--
            }
            
            this.$emit('update:count', count)
        }
    }
}
</script>

