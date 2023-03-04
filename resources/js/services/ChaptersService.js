import { ref } from 'vue'
import {scrollToTop} from "./tools/utils";

export default function useChapters() {
    const chapters = ref([])

    const getChapters = async (page, slug) => {
        let response = await axios.get('/webapi/books/chapters/' + slug + '?page=' + page)
        scrollToTop()
        chapters.value = response.data
    }

    const search = async (query, slug) => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/books/chapters/' + slug + '/' + query)
            chapters.value = response.data
        } else {
            await getChapters(1, slug)
        }
    }

    const likeChapter = async (index) => {
        let chapter = chapters.value.data[index]
        await axios.post('/webapi/chapters/like/' + chapter.id)

        chapters.value.data[index].like = !chapter.like
    }

    return { chapters, getChapters, search, likeChapter }
}
