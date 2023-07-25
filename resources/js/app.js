import './bootstrap'
import { createApp } from 'vue'

import Books from './components/books.vue'
import Chapters from './components/chapters.vue'
import Pages from './components/pages.vue'
import AdminImages from './components/admin/AdminImages.vue'
import { createPinia } from 'pinia'

const pinia = createPinia()
const app = createApp(undefined, undefined)

app.use(pinia)

app.component('Books', Books)
app.component('Chapters', Chapters)
app.component('Pages', Pages)
app.component('adminImages', AdminImages)

app.mount('#app')
