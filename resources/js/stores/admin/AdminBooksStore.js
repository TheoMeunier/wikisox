import {defineStore} from "pinia";
import {ref} from "vue";
import lang from "../../services/tools/lang";

export const useAdminBooksStore = defineStore('admin_books', () => {
    const books = ref([])
    const query = ref('')
    const i18n = lang()

    const getBooks = async page => {
        let response = await axios.get('/webapi/admin/books?page=' + page)
        books.value = response.data
    }

    const search = async query => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/admin/books/' + query.value)
            books.value = response.data
        } else {
            await getBooks()
        }
    }

    const deleteBook = async slug => {
        if (confirm(i18n.confirm.deleteBook)) {
            await axios.delete('/webapi/admin/books/delete/' + slug)
            await getBooks(1)
        }
    }

    return { books, query, getBooks, deleteBook, search }
})
