<script setup>
import Pagination from 'laravel-vue-pagination'
import { onMounted } from 'vue'
import '../services/tools/lang'
import lang from '../services/tools/lang'
import { useBooksStore } from '../stores/BooksStore'
import File from '../filemanager/components/File/File.vue'

const store = useBooksStore()
const i18n = lang()

onMounted(() => {
    store.getBooks(1)
})
</script>

<template>
    <main class="main" id="main">
        <div class="mt-2 mb-5 flex justify-end">
            <form class="input__icon">
                <div class="input__icon__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input v-model="store.query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup.prevent="store.search()" :placeholder="i18n.search" />
            </form>
        </div>

        <div class="articles__books mt-6">
            <slot v-for="(book, index) in store.books.data" :key="book.id">
                <article class="card" :class="book.like !== false ? 'card__like' : ''">
                    <a :href="book.url" class="card__img">
                        <img :src="book.image" :alt="book.name" width="280" height="100" />
                    </a>
                    <div class="card__body">
                        <h5 class="card__title">{{ book.name }}</h5>
                        <p class="card__text">{{ book.description }}</p>
                        <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ book.created_at }}
                            </span>
                            <a class="cursor-pointer" @click.prevent="store.likeBook(index)" :class="book.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                                <i class="fa-star mr-2" :class="book.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                            </a>
                        </p>
                    </div>
                </article>
            </slot>
        </div>

        <div class="d-flex justify-content-center">
            <Pagination :data="store.books" @pagination-change-page="store.getBooks"></Pagination>
        </div>
    </main>
</template>
