import { defineStore } from 'pinia'
import { ref } from 'vue'
import lang from '../../services/tools/lang'

export const useAdminUsersStore = defineStore('admin_users', () => {
    const users = ref([])
    const query = ref('')

    const getUsers = async page => {
        let response = await axios('/webapi/admin/users?page=' + page)
        users.value = response.data
    }

    const search = async query => {
        if (query.value.length > 3) {
            let response = await axios.get('/webapi/admin/users/' + query.value)
            users.value = response.data
        } else {
            await getUsers(1)
        }
    }

    return { users, query, getUsers, search }
})
