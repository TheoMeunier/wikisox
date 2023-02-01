<template>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control block mt-1" v-model="form.password" />
        </div>
        <div>
            <label for="confirmation">Confirmation</label>
            <input type="password" class="form-control block mt-1" v-model="form.confirm_password" />
        </div>
    </div>
    <div class="flex justify-end mt-3">
        <button class="btn btn__primary ml-3" @click.stop="update">Modifier mon mot de passe</button>
    </div>
</template>

<script setup>
import useAuthUser from '../../services/AuthService'
import { reactive } from 'vue'

const { updatePassword } = useAuthUser()

const form = reactive({
    password: '',
    confirm_password: '',
})

const reset = () => {
    form.password = ''
    form.confirm_password = ''
}

const update = async () => {
    await updatePassword({ ...form })
    await reset()
}
</script>
