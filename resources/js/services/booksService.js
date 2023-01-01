import {ref} from "vue";

export default function useBooks() {
    const books = ref([])

    const getBooks = async (page) => {
        let response = await axios.get('/api/books?page=' + page)
        books.value = response.data
    }

    const search = async (query) => {
        if (query.length > 3) {
            let response = await axios.get('/api/books/' + query)
            books.value = response.data
        } else {
            await getBooks()
        }
    }

    return {books, getBooks, search}
}