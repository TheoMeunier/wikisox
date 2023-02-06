<script setup>
import Pagination from 'laravel-vue-pagination'
import Like from './modules/like.vue'
import { onMounted, ref } from 'vue'
import useChapters from '../services/ChaptersService'
import usePages from '../services/PagesService'
import lang from "../services/tools/lang";

const props = defineProps({
    title: String,
    book: String,
    chapter: String,
})

const { pages, getPages, search } = usePages()
const query = ref('')
const i18n = lang()

onMounted(() => {
    getPages(1, props.book, props.chapter)
})

const searchBook = async () => {
    await search(query.value, props.book, props.chapter)
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
                <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchBook" :placeholder="i18n.search" />
            </form>
        </div>

        <div class="mt-6">
            <slot v-for="page in pages.data" :key="page.id">
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
            <Pagination :data="pages" @pagination-change-page="getPages"></Pagination>
        </div>
    </main>
</template>
