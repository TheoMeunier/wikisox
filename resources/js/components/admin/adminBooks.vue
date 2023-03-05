<template>
    <div class="flex justify-end pt-4 mr-5">
        <form class="input__icon">
            <div class="input__icon__icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchBook" :placeholder="i18n.search" />
        </form>
    </div>
    <div class="card__body">
        <table class="">
            <thead>
                <tr>
                    <th>{{ i18n.table.id }}</th>
                    <th>{{ i18n.table.image }}</th>
                    <th>{{ i18n.table.name }}</th>
                    <th>{{ i18n.table.slug }}</th>
                    <th>{{ i18n.table.like }}</th>
                    <th>{{ i18n.table.createTo }}</th>
                    <th>{{ i18n.table.createdAt }}</th>
                    <th>{{ i18n.table.updatedAt }}</th>
                    <th>{{ i18n.table.action.index }}</th>
                </tr>
            </thead>
            <tbody>
                <slot v-for="book in books.data" :key="books.id">
                    <tr>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ book.id }}
                            </p>
                        </td>
                        <td>
                            <img :src="book.image" :alt="book.name" width="40" height="auto" />
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ book.name }}
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ book.slug }}
                            </p>
                        </td>
                        <td>
                            <p class="whitespace-no-wrap" :class="book.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                                <i class="fa-star mr-2" :class="book.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ book.username }}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ book.created_at }}
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ book.updated_at }}
                            </p>
                        </td>
                        <td>
                            <p class="flex align-center">
                                <a :href="book.url" class="text-gray-900 whitespace-no-wrap">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                </a>
                                <button @click.prevent="deleteMyBook(book.slug)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </p>
                        </td>
                    </tr>
                </slot>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <Pagination :data="books" @pagination-change-page="getBooks"></Pagination>
    </div>
</template>

<script setup>
import Pagination from 'laravel-vue-pagination'
import AdminModalBookDelete from '../modal/admin/AdminModalBookDelete.vue'
import useAdminBook from '../../services/admin/AdminBooksService'
import { onMounted, ref } from 'vue'
import lang from '../../services/tools/lang'

const { books, getBooks, search, deleteBook } = useAdminBook()
const query = ref('')
const i18n = lang()

onMounted(() => {
    getBooks(1)
})

const searchBook = async () => {
    await search(query.value)
}

const deleteMyBook = async slug => {
    if (confirm(i18n.confirm.deleteBook)) {
        await deleteBook(slug)
    }
}
</script>
