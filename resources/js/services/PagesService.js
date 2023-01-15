import { ref } from 'vue'

export default function usePages() {
    const pages = ref([])

    const getPages = async (page, slug, slugChapter) => {
        let response = await axios.get('/webapi/books/chapters/' + slug + '/pages/' + slugChapter + '?page=' + page)
        pages.value = response.data
    }

    const search = async (query, slug, slugChapter) => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/books/chapters/' + slug + '/pages/' + slugChapter + '/' + query)
            pages.value = response.data
        } else {
            await getPages(1, slug, slugChapter)
        }
    }

    return { pages, getPages, search }
}
