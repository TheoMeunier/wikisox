<template>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="name">{{ i18n.input.name }}</label>
            <input type="text" class="form-control block mt-1" v-model="auth.name" />
        </div>
        <div>
            <label for="email">{{ i18n.input.email }}</label>
            <input type="email" class="form-control block mt-1" v-model="auth.email" />
        </div>
    </div>
    <div class="flex justify-end mt-3">
        <button class="btn btn__primary ml-3" @click.stop="update">{{ i18n.button.edit }}</button>
    </div>
</template>

<script setup>
import useAuthUser from '../../services/AuthService'
import { onMounted } from 'vue'
import lang from '../../services/tools/lang'

const { auth, getAuthUser, updateUser } = useAuthUser()
const i18n = lang()

onMounted(() => {
    getAuthUser()
})

const update = async () => {
    await updateUser()
}
</script>
