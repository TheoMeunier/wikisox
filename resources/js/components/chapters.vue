<script setup>
import Pagination from 'laravel-vue-pagination'
import { onMounted } from 'vue'
import lang from '../services/tools/lang'
import {useChaptersStore} from "../stores/ChaptersStore";

const props = defineProps({
    slug: String,
})

const store = useChaptersStore()
const i18n = lang()

onMounted(() => {
    store.getChapters(1, props.slug)
})
</script>

<template>
    <main class="main" id="main">
        <div class="mt-2 mb-5 flex justify-end">
            <form class="input__icon">
                <div class="input__icon__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input v-model="store.query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="store.search(props.slug)" :placeholder="i18n.search" />
            </form>
        </div>

        <div class="articles mt-6">
            <slot v-for="(chapter, index) in store.chapters.data" :key="chapter.id">
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
                            <a class="cursor-pointer" @click="store.likeChapter(index)" :class="chapter.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                                <i class="fa-star mr-2" :class="chapter.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                            </a>
                        </p>
                    </div>
                </article>
            </slot>
        </div>

        <div class="d-flex justify-content-center">
            <Pagination :data="store.chapters" @pagination-change-page="store.getChapters"></Pagination>
        </div>
    </main>
</template>
