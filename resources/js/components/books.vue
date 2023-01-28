<script setup>
import Pagination from 'laravel-vue-pagination'
import Like from './modules/like.vue'
import useBooks from '../services/booksService'
import { onMounted, ref } from 'vue'

const props = defineProps({
    title: String,
})

const { books, getBooks, search } = useBooks()
const query = ref('')

onMounted(() => {
    getBooks(1)
})

const searchBook = async () => {
    await search(query.value)
}
</script>

<template>
    <main class="main" id="main">
        <div class="mt-2 mb-5 justify__between">
            <h1>{{ title }}</h1>

            <form class="input__icon">
                <div class="input__icon__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchBook" placeholder="search" />
            </form>
        </div>

        <div class="articles mt-6">
            <slot v-for="book in books.data" :key="book.id">
                <article class="card" :class="book.like !== false ? 'card__like' : ''">
                    <a :href="book.url" class="card__img">
                        <img :src="book.image" :alt="book.name" width="280" height="100"/>
                    </a>
                    <div class="card__body">
                        <h5 class="card__title">{{ book.name }}</h5>
                        <p class="card__text">{{ book.description }}</p>
                        <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ book.created_at }}
                            </span>
                            <Like :data="book" :params="'books'" />
                        </p>
                    </div>
                </article>
            </slot>
        </div>

        <div class="d-flex justify-content-center">
            <Pagination :data="books" @pagination-change-page="getBooks"></Pagination>
        </div>
    </main>
</template>
