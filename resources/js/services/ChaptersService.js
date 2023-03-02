import { ref } from 'vue'

export default function useChapters() {
    const chapters = ref([])

    const getChapters = async (page, slug) => {
        let response = await axios.get('/webapi/books/chapters/' + slug + '?page=' + page)
        window.scrollTo({ top: 0, behavior: 'smooth' });
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

    const likeChapter = async (id, slug, data) => {
        await axios.post('/webapi/chapters/like/' + id, data)
        await getChapters(chapters.value.meta.current_page, slug)
    }

    return { chapters, getChapters, search, likeChapter }
}
