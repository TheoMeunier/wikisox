import './bootstrap'
import { createApp } from 'vue'

import Books from './components/books.vue'
import Chapters from './components/chapters.vue'
import Pages from './components/pages.vue'
import ProfileEdit from './components/profile/profileEdit.vue'
import ProfilePasswordEdit from './components/profile/profilePasswordEdit.vue'
import AdminImages from './components/admin/AdminImages.vue'
import { createPinia } from 'pinia'
import ProfileLog from "./components/profile/profileLog.vue";

const pinia = createPinia()
const app = createApp(undefined, undefined)

app.use(pinia)

app.component('Books', Books)
app.component('Chapters', Chapters)
app.component('Pages', Pages)
app.component('profileEdit', ProfileEdit)
app.component('profilePasswordEdit', ProfilePasswordEdit)
app.component('profileLog', ProfileLog)
app.component('adminImages', AdminImages)

app.mount('#app')
