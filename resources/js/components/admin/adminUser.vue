<template>
    <div class="flex justify-end pt-4 mr-5">
        <form class="input__icon">
            <div class="input__icon__icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchUser" :placeholder="i18n.search" />
        </form>
    </div>
    <div class="card__body">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th>{{ i18n.table.id }}</th>
                    <th>{{ i18n.table.name }}</th>
                    <th>{{ i18n.table.email }}</th>
                    <th>{{ i18n.table.roles }}</th>
                    <th>{{ i18n.table.verify }}</th>
                    <th>{{ i18n.table.createdAt }}</th>
                    <th>{{ i18n.table.updatedAt }}</th>
                    <th>{{ i18n.table.action.index }}</th>
                </tr>
            </thead>
            <tbody>
                <slot v-for="user in users.data" :key="user.id">
                    <tr>
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>Mon Roles</td>
                        <td>
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight" :class="user.verify === null ? 'text-red-900' : 'text-green-900'">
                                <span class="absolute inset-0 rounded-full opacity-50" :class="false ? 'bg-red-200' : 'bg-green-200'"> </span>
                                <span v-if="false" class="relative">not verify</span>
                                <span v-else class="relative">verify</span>
                            </span>
                        </td>
                        <td>{{ user.created_at }}</td>
                        <td>{{ user.updated_at }}</td>
                        <td class="flex items-center pointer">
                            <a :href="user.edit">
                                <i class="fa-solid fa-pen-to-square mr-2"></i>
                            </a>
                        </td>
                    </tr>
                </slot>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <Pagination :data="users" :limit="4" @pagination-change-page="getUsers"></Pagination>
    </div>
</template>

<script setup>
import Pagination from 'laravel-vue-pagination'
import { onMounted, ref } from 'vue'
import { useAdminUser } from '../../services/admin/AdminUserService'
import lang from '../../services/tools/lang'

const { users, getUsers, search } = useAdminUser()
const query = ref('')
const i18n = lang()

onMounted(() => {
    getUsers(1)
})

const searchUser = async () => {
    await search(query.value)
}
</script>
