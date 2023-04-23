import {defineStore} from "pinia";
import {ref} from "vue";
import {scrollToTop} from "../services/tools/utils";

export const useBooksStore = defineStore('books', () => {
    const books = ref({})
    const query = ref('')

    const getBooks = async page => {
        let response = await axios.get('/webapi/books?page=' + page)
        scrollToTop()
        books.value = response.data
    }

    const search = async () => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/books/' + query.value)
            books.value = response.data
        } else {
            await getBooks()
        }
    }

    const likeBook = async (index) => {
        let book = books.value.data[index]
        await axios.post('/webapi/books/like/' + book.id)

        books.value.data[index].like = !book.like
    }

    return {books, query, getBooks, search, likeBook}
})
