import { ref } from 'vue'

export default function useAdminPage() {
    const pages = ref([])

    const getPages = async page => {
        let response = await axios.get('/webapi/admin/pages?page=' + page)
        pages.value = response.data
    }

    const search = async query => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/admin/pages/' + query)
            pages.value = response.data
        } else {
            await getPages()
        }
    }

    const deletePage = async slug => {
        await axios.delete('/webapi/books/delete' + slug)
    }

    return { pages, getPages, deletePage, search }
}
