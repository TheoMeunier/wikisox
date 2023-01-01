import './bootstrap';
import './libs/index'

import {createApp} from "vue";
import Books from "./components/books.vue";

const app = createApp();
app.component('Books', Books)
app.mount('#app')