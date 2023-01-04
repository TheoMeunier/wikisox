import {ref} from "vue";

export default function useBooks() {
    const books = ref([])

    const getBooks = async (page) => {
        let response = await axios.get('/webapi/books?page=' + page)
        books.value = response.data
    }

    const search = async (query) => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/books/' + query)
            books.value = response.data
        } else {
            await getBooks()
        }
    }

    const deleteBook = async (slug) => {
        await axios.delete('/webapi/books/delete' + slug)
    }

    return {books, getBooks, deleteBook, search}
}