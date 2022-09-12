import { createApp } from "vue";
require("./bootstrap");
import { createPinia } from 'pinia'
import App from "./App.vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

const pinia = createPinia()
const app = createApp(App)
app.component('v-select', vSelect)
app.use(pinia)
app.mount('#app')