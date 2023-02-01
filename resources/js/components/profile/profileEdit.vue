<template>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="name">Name</label>
            <input type="text" class="form-control block mt-1" v-model="auth.name" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" class="form-control block mt-1" v-model="auth.email" />
        </div>
    </div>
    <div class="flex justify-end mt-3">
        <button class="btn btn__primary ml-3" @click.stop="update">Modifier</button>
    </div>
</template>

<script setup>
import useAuthUser from '../../services/AuthService'
import { onMounted } from 'vue'

const { auth, getAuthUser, updateUser } = useAuthUser()

onMounted(() => {
    getAuthUser()
})

const update = async () => {
    await updateUser()
}
</script>
