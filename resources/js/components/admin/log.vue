<template>
    <div>
        <div class="card__body">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th>lang.i18n.table.id</th>
                        <th>lang.i18n.table.username</th>
                        <th>lang.i18n.table.action</th>
                        <th>lang.i18n.table.subject_name</th>
                        <th>lang.i18n.table.createdAt</th>
                        <th>lang.i18n.table.updatedAt</th>
                    </tr>
                </thead>
                <tbody>
                    <slot v-for="log in logs.data" :key="log.id">
                        <tr>
                            <td>{{ log.id }}</td>
                            <td>{{ log.username }}</td>
                            <td>
                                <p v-if="log.event === 'created'" class="whitespace-no-wrap">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span class="absolute inset-0 rounded-full bg-green-200 opacity-50" />
                                        <span class="relative"> lang.i18n.tag.created </span>
                                    </span>
                                </p>
                                <p v-else-if="log.event === 'updated'" class="whitespace-no-wrap">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-orange-900">
                                        <span class="absolute inset-0 rounded-full bg-orange-200 opacity-50" />
                                        <span class="relative"> lang.i18n.tag.updated </span>
                                    </span>
                                </p>
                                <p v-else-if="log.event === 'deleted'" class="whitespace-no-wrap">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-red-900">
                                        <span class="absolute inset-0 rounded-full bg-red-200 opacity-50" />
                                        <span class="relative"> lang.i18n.tag.deleted </span>
                                    </span>
                                </p>
                            </td>
                            <td>{{ log.subject_name }}</td>
                            <td>{{ log.created_at }}</td>
                            <td>{{ log.updated_at }}</td>
                        </tr>
                    </slot>
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <Pagination :data="logs" @pagination-change-page="getLogs"> </Pagination>
            </div>
        </div>
    </div>
</template>

<script setup>
import Pagination from 'laravel-vue-pagination'
import useLogs from '../../services/admin/logsServices'
import { onMounted } from 'vue'

const { logs, getLogs } = useLogs()

onMounted(() => {
    getLogs(1)
})
</script>
