<template>
    <div class="flex justify-end pt-4 mr-5">
        <form class="input__icon">
            <div class="input__icon__icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input
                v-model="query"
                type="text"
                class="input__icon__input w-64"
                id="example-search-input"
                @keyup="searchChapter"
                :placeholder="i18n.search"
            />
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
                    <th>{{ i18n.table.book }}</th>
                    <th>{{ i18n.table.like }}</th>
                    <th>{{ i18n.table.createTo }}</th>
                    <th>{{ i18n.table.createdAt }}</th>
                    <th>{{ i18n.table.updatedAt }}</th>
                    <th>{{ i18n.table.action.index }}</th>
                </tr>
            </thead>
            <tbody>
                <slot v-for="chapter in chapters.data" :key="chapter.id">
                    <tr>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ chapter.id }}
                            </p>
                        </td>
                        <td>
                            <img :src="chapter.image" :alt="chapter.name" width="40" height="auto" />
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ chapter.name }}
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ chapter.slug }}
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ chapter.book }}
                            </p>
                        </td>
                        <td>
                            <p class="whitespace-no-wrap" :class="chapter.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                                <i class="fa-star mr-2" :class="chapter.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ chapter.username }}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ chapter.created_at }}
                            </p>
                        </td>
                        <td>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ chapter.updated_at }}
                            </p>
                        </td>
                        <td>
                            <p class="flex align-center">
                                <a :href="chapter.url" class="text-gray-900 whitespace-no-wrap">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                </a>
                            </p>
                        </td>
                    </tr>
                </slot>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <Pagination :data="chapters" :limit="4" @pagination-change-page="getChapters"></Pagination>
    </div>
</template>

<script setup>
import Pagination from 'laravel-vue-pagination'
import useAdminChapter from '../../services/admin/AdminChaptersService'
import { onMounted, ref } from 'vue'
import lang from "../../services/tools/lang";

const { chapters, getChapters, search } = useAdminChapter()
const query = ref('')
const i18n = lang()

onMounted(() => {
    getChapters(1)
})

const searchChapter = async () => {
    await search(query.value)
}
</script>
