import {defineStore} from "pinia";
import {ref} from "vue";
import lang from "../../services/tools/lang";

export const useAdminPagesStore = defineStore('admin_pages', () => {
    const pages = ref([])
    const query = ref('')
    const i18n = lang()

    const getPages = async page => {
        let response = await axios.get('/webapi/admin/pages?page=' + page)
        pages.value = response.data
    }

    const search = async query => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/admin/pages/' + query.value)
            pages.value = response.data
        } else {
            await getPages()
        }
    }

    const deletePage = async slug => {
        if (confirm(i18n.confirm.deletePage)){
            await axios.delete('/webapi/admin/pages/delete/' + slug)
            await getPages(1)
        }
    }

    return { pages, query, getPages, deletePage, search }
})
