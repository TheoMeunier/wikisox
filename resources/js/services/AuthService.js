import { ref } from 'vue'

export default function useAuthUser() {
    const auth = ref([])
    const errors = ref({
        name: '',
        email: '',
    })

    const getAuthUser = async () => {
        let response = await axios.get('/webapi/auth')
        auth.value = response.data.data
    }

    const updateUser = async () => {
        try {
            await axios.put(`/webapi/profile/update`, auth.value)
        } catch (e) {
            for (const key in e.response.data.errors) {
                errors.value[key] += e.response.data.errors[key][0] + ' '
            }
        }
    }

    const updatePassword = async data => {
        try {
            await axios.put(`/webapi/profile/update/password`, data)
        } catch (e) {
            for (const key in e.response.data.errors) {
                errors.value[key] += e.response.data.errors[key][0] + ' '
            }
        }
    }

    return { auth, getAuthUser, updateUser, updatePassword, errors }
}
