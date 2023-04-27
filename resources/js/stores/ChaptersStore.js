import { defineStore } from 'pinia'
import { ref } from 'vue'
import { scrollToTop } from '../services/tools/utils'

export const useChaptersStore = defineStore('chapters', () => {
    const chapters = ref([])
    const query = ref('')
    const props = ref('')

    const getChapters = async (page = 1) => {
        let response = await axios.get('/webapi/books/chapters/' + props.value + '?page=' + page)
        scrollToTop()
        chapters.value = response.data
    }

    const search = async () => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/books/chapters/' + props.value + '/' + query.value)
            chapters.value = response.data
        } else {
            await getChapters()
        }
    }

    const likeChapter = async index => {
        let chapter = chapters.value.data[index]
        await axios.post('/webapi/chapters/like/' + chapter.id)

        chapters.value.data[index].like = !chapter.like
    }

    return { chapters, query, props, getChapters, search, likeChapter }
})
