import { ref } from 'vue'

export default function useAuthUser() {
    const auth = ref([])
    const errorsEdit = ref({
        name: '',
        email: '',
    })

    const errorsPassword = ref({
        password: '',
        password_confirmation: '',
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
                errorsEdit.value[key] += e.response.data.errors[key][0] + ' '
            }
        }
    }

    const updatePassword = async data => {
        try {
            await axios.put(`/webapi/profile/update/password`, data)
        } catch (e) {
            for (const key in e.response.data.errors) {
                errorsPassword.value[key] += e.response.data.errors[key][0] + ' '
            }
        }
    }

    return { auth, getAuthUser, updateUser, updatePassword, errorsEdit, errorsPassword }
}
