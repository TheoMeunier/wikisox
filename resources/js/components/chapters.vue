<script setup>
import Pagination from 'laravel-vue-pagination'
import Like from './modules/like.vue'
import { onMounted, ref } from 'vue'
import useChapters from '../services/ChaptersService'
import lang from "../services/tools/lang";

const props = defineProps({
    slug: String,
})

const { chapters, getChapters, search, likeChapter } = useChapters()
const query = ref('')
const i18n = lang()

onMounted(() => {
    getChapters(1, props.slug)
})

const searchBook = async () => {
    await search(query.value, props.slug)
}

const like = async id => {
    await likeChapter(id, props.slug)
}
</script>

<template>
    <main class="main" id="main">
        <div class="mt-2 mb-5 flex justify-end">
            <form class="input__icon">
                <div class="input__icon__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchBook" :placeholder="i18n.search" />
            </form>
        </div>

        <div class="articles mt-6">
            <slot v-for="chapter in chapters.data" :key="chapter.id">
                <article class="card" :class="chapter.like !== false ? 'card__like' : ''">
                    <a :href="chapter.url + '/' + slug + '/' + chapter.slug" class="card__img">
                        <img :src="chapter.image" :alt="chapter.name" width="280" height="100" />
                    </a>
                    <div class="card__body">
                        <h5 class="card__title">{{ chapter.name }}</h5>
                        <p class="card__text">{{ chapter.description }}</p>
                        <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ chapter.created_at }}
                            </span>
                            <a class="cursor-pointer" @click="like(chapter.id)" :class="chapter.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                                <i class="fa-star mr-2" :class="chapter.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                            </a>
                        </p>
                    </div>
                </article>
            </slot>
        </div>

        <div class="d-flex justify-content-center">
            <Pagination :data="chapters" @pagination-change-page="getChapters"></Pagination>
        </div>
    </main>
</template>
