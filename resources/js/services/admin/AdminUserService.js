import { ref } from 'vue'

export function useAdminUser() {
    const users = ref([])

    const getUsers = async page => {
        let response = await axios('/webapi/admin/users?page=' + page)
        users.value = response.data
    }

    const search = async query => {
        if (query.length > 3) {
            let response = await axios.get('/webapi/admin/pages/' + query)
            users.value = response.data
        } else {
            await getUsers(1)
        }
    }

    return { users, getUsers, search }
}
