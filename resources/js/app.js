import './bootstrap';
import './libs/index'

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import {createApp} from "vue";
import Books from "./components/books.vue";

const app = createApp();
app.component('Books', Books)
app.mount('#app')