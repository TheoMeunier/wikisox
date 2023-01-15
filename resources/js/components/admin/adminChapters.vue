<template>
    <div class="flex justify-end pt-4 mr-5">
        <form class="input__icon">
            <div class="input__icon__icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input v-model="query" type="text" class="input__icon__input w-64" id="example-search-input" @keyup="searchChapter" placeholder="search" />
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
                    <th>Livre</th>
                    <th>like</th>
                    <th>createdTo</th>
                    <th>createdAt</th>
                    <th>updatedAt</th>
                    <th>action</th>
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
</template>

<script setup>
import useAdminChapter from '../../services/admin/AdminChaptersService'
import { onMounted, ref } from 'vue'

const { chapters, getChapters, search } = useAdminChapter()
const query = ref('')

onMounted(() => {
    getChapters(1)
})

const searchChapter = async () => {
    await search(query.value)
}
</script>
