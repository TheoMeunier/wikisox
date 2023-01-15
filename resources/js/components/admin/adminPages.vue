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
                @keyup="searchPage"
                placeholder="search"/>
        </form>
    </div>
    <div class="card__body">
        <table class="min-w-full leading-normal">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>slug</th>
                <th>chapter</th>
                <th>like</th>
                <th>createdTo</th>
                <th>createdAt</th>
                <th>updatedAt</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            <slot v-for="page in pages.data" :key="page.id">
                <tr>
                    <td>{{ page.id }}</td>
                    <td>{{ page.name }}</td>
                    <td>{{ page.slug }}</td>
                    <td>{{ page.chapter }}</td>
                    <td :class="page.like !== false ? 'text-yellow-400' : 'text-gray-500'">
                        <i class="fa-star mr-2" :class="page.like !== false ? 'fa-solid' : 'fa-regular'"></i>
                    </td>
                    <td>{{ page.username }}</td>
                    <td>{{ page.created_at }}</td>
                    <td>{{ page.updated_at }}</td>
                    <td class="flex items-center">
                        <a :href="page.url">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                        </a>
                    </td>
                </tr>
            </slot>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import useAdminPage from "../../services/admin/AdminPagesService";
import {onMounted, ref} from "vue";

const {pages, getPages, search} = useAdminPage()
const query = ref('')

onMounted(() => {
    getPages(1)
})

const searchPage = async () => {
    await search(query.value)
}
</script>
