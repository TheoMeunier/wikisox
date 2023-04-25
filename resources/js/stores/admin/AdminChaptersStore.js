import { defineStore } from 'pinia'
import { ref } from 'vue'
import lang from '../../services/tools/lang'

export const useAdminChaptersStore = defineStore('admin_chapters', () => {
    const chapters = ref([])
    const query = ref('')
    const i18n = lang()

    const getChapters = async page => {
        let response = await axios.get('/webapi/admin/chapters?page=' + page)
        chapters.value = response.data
    }

    const search = async () => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/admin/chapters/' + query.value)
            chapters.value = response.data
        } else {
            await getChapters()
        }
    }

    const deleteChapter = async slug => {
        if (confirm(i18n.confirm.deleteChapter)) {
            await axios.delete('/webapi/admin/chapters/delete/' + slug)
            await getChapters(1)
        }
    }

    return { chapters, query, getChapters, deleteChapter, search }
})
