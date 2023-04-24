import { defineStore } from 'pinia'
import { ref } from 'vue'

export const usePagesStore = defineStore('pages', () => {
    const pages = ref([])
    const query = ref('')

    const getPages = async (page, slug, slugChapter) => {
        let response = await axios.get('/webapi/books/chapters/' + slug + '/pages/' + slugChapter + '?page=' + page)
        window.scrollTo({ top: 0, behavior: 'smooth' })
        pages.value = response.data
    }

    const search = async (slug, slugChapter) => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/books/chapters/' + slug + '/pages/' + slugChapter + '/' + query.value)
            pages.value = response.data
        } else {
            await getPages(1, slug, slugChapter)
        }
    }

    return { pages, query, getPages, search }
})
