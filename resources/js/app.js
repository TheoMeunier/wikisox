import './bootstrap';
import {createApp} from "vue";

import Books from "./components/books.vue";
import Chapters from "./components/chapters.vue";
import ModalBookDelete from "./components/modal/ModalBookDelete.vue";

const app = createApp();
app.component('Books', Books)
app.component('ModalBookDelete', ModalBookDelete)
app.component('Chapters', Chapters)
app.mount('#app')
