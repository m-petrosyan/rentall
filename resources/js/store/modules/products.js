import img from "../../../assets/images/14383918.jpg";

export default {
    state: {
        products: [
            {
                id: 1,
                img: img,
                title: "ARRI Alexa 35",
                price: 50000
            },
            {
                id: 2,
                img: img,
                title: "ARRI Alexa 35",
                price: 50000
            },
            {
                id: 3,
                img: img,
                title: "ARRI Alexa 35",
                price: 50000
            },
            {
                id: 4,
                img: img,
                title: "ARRI Alexa 35",
                price: 50000
            },
            {
                id: 5,
                img: img,
                title: "ARRI Alexa 35",
                price: 50000
            },
            {
                id: 6,
                img: img,
                title: "ARRI Alexa 35",
                price: 50000
            },
        ],
        productsError: null,
    },
    getters: {
        getProducts: state => state.products,
        getProduct: (state) => (id) => {
            return state.products.find(el => el.id === +id)
        },
    },
    mutations: {
        // setWeatherError(state, data) {
        //     state.weatherError = data
        // },
        // setWeather(state, data) {
        //     state.weather = data
        // },
    },
    actions: {
        // getWeather({commit}, {city, units}) {
        //     return getRequest(`/weather?city=${city}&units=${units}`)
        //         .then(response => {
        //             commit("setWeather", response.data)
        //             commit('setWeatherError', null)
        //         })
        //         .catch(error => {
        //             commit('setWeatherError', error)
        //             return Promise.reject(error)
        //         });
        // },
        // getWeatherHistory({commit}, city) {
        //     return getRequest(`/weather/history`)
        //         .then(response => {
        //             commit("setWeatherHistory", response.data)
        //             commit('setWeatherError', null)
        //         })
        //         .catch(error => {
        //             commit('setWeatherError', error)
        //             return Promise.reject(error)
        //         });
        // },
    },
}
