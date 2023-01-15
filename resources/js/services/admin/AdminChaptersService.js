import { ref } from 'vue'

export default function useAdminChapter() {
    const chapters = ref([])

    const getChapters = async page => {
        let response = await axios.get('/webapi/admin/chapters?page=' + page)
        chapters.value = response.data
    }

    const search = async query => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/admin/chapters/' + query)
            chapters.value = response.data
        } else {
            await getChapters()
        }
    }

    const deleteBook = async slug => {
        await axios.delete('/webapi/books/delete' + slug)
    }

    return { chapters, getChapters, deleteBook, search }
}
