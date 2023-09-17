<template>
    <menu>
        <ul class="flex gap-x-5 justify-center">
            <li v-for="category in categories" :key="category.id">
                <button class="font-semibold">{{ category.title }}</button>
            </li>
        </ul>
    </menu>
</template>

<script>
export default {
    data() {
        return {
            categories: [
                {
                    id: 1,
                    title: "Все"
                },
                {
                    id: 2,
                    title: "Камеры"
                },
                {
                    id: 3,
                    title: "Оптика"
                },
                {
                    id: 4,
                    title: "Головы и штативы"
                },
                {
                    id: 5,
                    title: "Аксессуары"
                },
                {
                    id: 6,
                    title: "Мониторы"
                },
                {
                    id: 7,
                    title: "Видеосендеры"
                },
                {
                    id: 8,
                    title: "Стабилизация"
                }, {
                    id: 9,
                    title: "Фильтры"
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
