export default {
    data() {
        return {
            cart: JSON.parse(localStorage.getItem('cart')) ?? []
        }
    },
    methods: {
        setStorage(key, newData, clear = false) {
            const storageData = clear
                ? newData
                : JSON.parse(localStorage.getItem(key)) ?? []
            if (!clear) {
                storageData.push(newData)
            }
            localStorage.setItem(key, JSON.stringify(storageData));
            this[key] = JSON.parse(localStorage.getItem(key))
        },
    },
}
