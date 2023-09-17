<template>
    <div class="container">
        <VDatePicker
            :first-day-of-week="2"
            :color="selectedColor"
            @dayclick='dayClick'
            v-model.range="selectedDate"
        />
    </div>
</template>

<script>
export default {
    data() {
        return {
            range: {},
            mode: 'date',
            selectedColor: 'orange',
            selectedDate: {},
        }
    },
    methods: {
        dayClick(e) {
            console.log(e)
        }
    }
}
</script>

<style>

</style>
