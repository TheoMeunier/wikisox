import { ref } from 'vue'

export default function useLogs() {
    const logs = ref([])

    const getLogs = async page => {
        let response = await axios.get('/webapi/admin/logs?page' + page)
        logs.value = response.data
    }

    return { logs, getLogs }
}
