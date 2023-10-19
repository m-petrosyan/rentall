import {createApp} from 'vue';
import App from './App.vue';
import router from "./router";
import store from './store'
import VCalendar from 'v-calendar';
import vSelect from "vue-select";
import moment from 'moment'

//styles
import 'v-calendar/style.css';
import '../assets/styles/style.scss'
import '../assets/styles/main.scss'
import '../assets/styles/moretoggles.min.css'
import 'vue-select/dist/vue-select.css';

createApp(App)
    .use(moment)
    .use(store)
    .use(router)
    .use(VCalendar)
    .component("v-select", vSelect)
    .mount('#app')
