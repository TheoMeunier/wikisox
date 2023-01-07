import {ref} from "vue";

export default function useChapters() {
    const chapters = ref([])

    const getChapters = async (page) => {
        let response = await axios.get('/webapi/chapters' + '?page=' + page)
        chapters.value = response.data
    }

    const search = async (query) => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/chapters/' + query)
            chapters.value = response.data
        } else {
            await getChapters()
        }
    }

    return {chapters, getChapters, search}
}