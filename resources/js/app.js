import {createApp} from 'vue';
import App from './App.vue';
import router from "./router";
import store from './store'
import 'v-calendar/style.css';
import VCalendar from 'v-calendar';
import '../assets/styles/style.scss'

createApp(App)
    .use(store)
    .use(router)
    .use(VCalendar)
    .mount('#app')
