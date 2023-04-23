<script setup>
import Pagination from 'laravel-vue-pagination'
import { onMounted } from 'vue'
import lang from '../services/tools/lang'
import {usePagesStore} from "../stores/PagesStore";

const props = defineProps({
    book: String,
    chapter: String,
})

const store = usePagesStore()
const i18n = lang()

onMounted(() => {
    store.getPages(1, props.book, props.chapter)
})
</script>

<template>
    <main class="main" id="main">
        <div class="mt-2 mb-5 flex justify-end">
            <form class="input__icon">
                <div class="input__icon__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input v-model="store.query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="store.searchBook(props.book, props.chapter)" :placeholder="i18n.search" />
            </form>
        </div>

        <div class="mt-6">
            <slot v-for="page in store.pages.data" :key="page.id">
                <a :href="/books/ + props.book + '/' + props.chapter + '/' + page.slug">
                    <article class="card">
                        <div class="card__body justify__between">
                            <h5 class="card__title border-left">{{ page.name }}</h5>
                            <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ page.created_at }}
                            </span>
                        </div>
                    </article>
                </a>
            </slot>
        </div>

        <div class="d-flex justify-content-center">
            <Pagination :data="store.pages" @pagination-change-page="store.getPages"></Pagination>
        </div>
    </main>
</template>
