<template>
    <div class="flex justify-end pt-4 mr-5">
        <form class="input__icon">
            <div class="input__icon__icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input v-model="store.query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="store.searchPage" :placeholder="i18n.search" />
        </form>
    </div>
    <div class="card__body">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th>{{ i18n.table.id }}</th>
                    <th>{{ i18n.table.name }}</th>
                    <th>{{ i18n.table.slug }}</th>
                    <th>{{ i18n.table.description }}</th>
                    <th>{{ i18n.table.like }}</th>
                    <th>{{ i18n.table.createTo }}</th>
                    <th>{{ i18n.table.createdAt }}</th>
                    <th>{{ i18n.table.updatedAt }}</th>
                    <th>{{ i18n.table.action.index }}</th>
                </tr>
            </thead>
            <tbody>
                <slot v-for="page in store.pages.data" :key="page.id">
                    <tr>
                        <td>{{ page.id }}</td>
                        <td>{{ page.name }}</td>
                        <td>{{ page.slug }}</td>
                        <td>{{ page.chapter }}</td>
                        <td :class="page.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                            <i class="fa-star mr-2" :class="page.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                        </td>
                        <td>{{ page.username }}</td>
                        <td>{{ page.created_at }}</td>
                        <td>{{ page.updated_at }}</td>
                        <td class="flex justify-start items-center">
                            <a :href="page.url">
                                <i class="fa-solid fa-pen-to-square mr-2"></i>
                            </a>
                            <button @click.prevent="store.deletePage(page.slug)">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </slot>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <Pagination :data="store.pages" :limit="4" @pagination-change-page="store.getPages"></Pagination>
    </div>
</template>

<script setup>
import Pagination from 'laravel-vue-pagination'
import { onMounted } from 'vue'
import lang from '../../services/tools/lang'
import { useAdminPagesStore } from '../../stores/admin/AdminPagesStore'

const store = useAdminPagesStore()
const i18n = lang()

onMounted(() => {
    store.getPages(1)
})
</script>
