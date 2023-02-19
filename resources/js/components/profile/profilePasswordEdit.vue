<template>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="password">{{ i18n.input.password }}</label>
            <input type="password" class="form-control block mt-1" v-model="form.password" />
            <div v-if="errorsPassword.password !== null">
                <p class="text-red-500">{{ errorsPassword.password }}</p>
            </div>
        </div>
        <div>
            <label for="password_confirmation">{{ i18n.input.confirmationPassword }}</label>
            <input type="password" class="form-control block mt-1" v-model="form.password_confirmation" />
            <div v-if="errorsPassword.password_confirmation !== null">
                <p class="text-red-500">{{ errorsPassword.password_confirmation }}</p>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-3">
        <button class="btn btn__primary ml-3" @click.stop="update">{{ i18n.button.editPassword }}</button>
    </div>
</template>

<script setup>
import useAuthUser from '../../services/AuthService'
import { reactive } from 'vue'
import lang from '../../services/tools/lang'

const { updatePassword, errorsPassword } = useAuthUser()
const i18n = lang()

const form = reactive({
    password: '',
    password_confirmation: '',
})

const reset = () => {
    form.password = ''
    form.password_confirmation = ''
}

const update = async () => {
    await updatePassword({ ...form })
    await reset()
}
</script>
