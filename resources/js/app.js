import './bootstrap'
import { createApp } from 'vue'

import Books from './components/books.vue'
import Chapters from './components/chapters.vue'
import Pages from './components/pages.vue'
import Logs from './components/admin/log.vue'
import AdminBooks from './components/admin/adminBooks.vue'
import AdminChapters from './components/admin/adminChapters.vue'
import AdminPages from './components/admin/adminPages.vue'
import AdminUser from './components/admin/adminUser.vue'
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
app.component('Logs', Logs)
app.component('profileEdit', ProfileEdit)
app.component('profilePasswordEdit', ProfilePasswordEdit)
app.component('profileLog', ProfileLog)
app.component('adminBooks', AdminBooks)
app.component('adminChapters', AdminChapters)
app.component('adminPages', AdminPages)
app.component('adminUsers', AdminUser)
app.component('adminImages', AdminImages)

app.mount('#app')
