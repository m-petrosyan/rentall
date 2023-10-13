export default {
    data() {
        return {
            cart: JSON.parse(localStorage.getItem('cart')) ?? []
        }
    },
    methods: {
        setStorage(key, newData) {
            const data = JSON.parse(localStorage.getItem(key)) ?? []
            data.push(newData)

            localStorage.setItem(key, JSON.stringify(data));
            this[key] = JSON.parse(localStorage.getItem(key))
        },
    },
}
