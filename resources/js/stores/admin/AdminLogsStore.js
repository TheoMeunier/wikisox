import {defineStore} from "pinia";
import {ref} from "vue";

export const useAdminLogsStore = defineStore('admin_logs', () => {
    const logs = ref([])

    const getLogs = async page => {
        let response = await axios.get('/webapi/admin/logs?page=' + page)
        logs.value = response.data
    }

    return { logs, getLogs }
})
