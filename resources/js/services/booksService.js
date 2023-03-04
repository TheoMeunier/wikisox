import { ref } from 'vue'
import {scrollToTop} from "./tools/utils";

export default function useBooks() {
    const books = ref([])

    const getBooks = async page => {
        let response = await axios.get('/webapi/books?page=' + page)
        scrollToTop()
        books.value = response.data
    }

    const search = async query => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/books/' + query)
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

    return { books, getBooks, search, likeBook }
}
