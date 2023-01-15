<template>
    <div class="flex justify-end pt-4 mr-5">
        <form class="input__icon">
            <div class="input__icon__icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchBook" placeholder="search" />
        </form>
    </div>
    <div class="card__body">
        <table class="">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>slug</th>
                    <th>like</th>
                    <th>createdTo</th>
                    <th>createdAt</th>
                    <th>updatedAt</th>
                    <th>action</th>
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
                                <ModalBookDelete :book="book" @delete-book="deleteMyBook(book)" />
                            </p>
                        </td>
                    </tr>
                </slot>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import ModalBookDelete from '../modal/admin/ModalBookDelete.vue'
import useAdminBook from '../../services/admin/AdminBooksService'
import { onMounted, ref } from 'vue'
import { useTransStore } from '../../Store/trans'

const { books, getBooks, search, deleteBook } = useAdminBook()
const query = ref('')

onMounted(() => {
    getBooks(1)
})

const searchBook = async () => {
    await search(query.value)
}

const deleteMyBook = async book => {
    await deleteBook(book.slug)
}
</script>
