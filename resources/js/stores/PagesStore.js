import { defineStore } from 'pinia'
import { ref } from 'vue'

export const usePagesStore = defineStore('pages', () => {
    const pages = ref([])
    const query = ref('')
    const props = ref({
        book: '',
        chapter: ''
    })

    const getPages = async (page = 1) => {
        let response = await axios.get('/webapi/books/chapters/' + props.value.book + '/pages/' + props.value.chapter + '?page=' + page)
        window.scrollTo({ top: 0, behavior: 'smooth' })
        pages.value = response.data
    }

    const search = async () => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/books/chapters/' + props.value.book + '/pages/' + props.value.chapter + '/' + query.value)
            pages.value = response.data
        } else {
            await getPages()
        }
    }

    return { pages, query, props, getPages, search }
})
