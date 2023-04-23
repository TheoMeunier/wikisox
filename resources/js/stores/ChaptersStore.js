import {defineStore} from "pinia";
import {ref} from "vue";
import {scrollToTop} from "../services/tools/utils";

export const useChaptersStore = defineStore('chapters', () => {
    const chapters = ref([])
    const query = ref('')

    const getChapters = async (page, slug) => {
        let response = await axios.get('/webapi/books/chapters/' + slug + '?page=' + page)
        scrollToTop()
        chapters.value = response.data
    }

    const search = async (slug) => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/books/chapters/' + slug + '/' + query.value)
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

    return { chapters, query, getChapters, search, likeChapter }
})
