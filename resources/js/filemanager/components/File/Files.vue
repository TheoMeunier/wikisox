<template>
    <div v-if="store.files.length" class="flex flex-wrap gap-y-4 py-6">
        <slot v-for="file in store.files" :key="file.id">
            <file :file="file" v-show="!file.disable" />
        </slot>
    </div>
    <div v-else class="flex flex-wrap gap-y-4 py-6 h-full">
        <div class="flex flex-col items-center justify-center text-gray-400 w-full">
            <p class="text-2xl py-3">{{ i18n.filemanager.folder.empty_folder }}</p>
            <p class="text-xl py-4">{{ i18n.filemanager.drop_file }}<i class="fa-solid fa-file-arrow-down ml-2"></i></p>
            <button class="btn btn__danger" v-if="storeFolder.selectFolder && !storeFolder.selectFolder.children.length" @click.prevent="removeFolder">
                {{ i18n.filemanager.folder.btn_delete_folder }}
            </button>
        </div>
    </div>
</template>

<script setup>
import File from './File.vue'
import { useFoldersStore } from '../../store/FoldersStore.js'
import { onMounted } from 'vue'
import { useFilesStore } from '../../store/FilesStore.js'
import lang from '../../../services/tools/lang'
const i18n = lang()

const store = useFilesStore()
const storeFolder = useFoldersStore()

onMounted(() => {
    storeFolder.addFileToFolder()
})

const removeFolder = async () => {
    if (confirm(i18n.filemanager.folder.confirm_delete)) {
        await storeFolder.deleteFolder(storeFolder.selectFolder)
        storeFolder.selectFolder.value = null
    }
}
</script>

<style scoped>
.btn__danger {
    display: block;
    margin: 0 auto;
    background: #d70d0d;
    color: white;
    padding: 10px 8px;
    border-radius: 5px;
}

.btn__danger:hover {
    background: #b60e0e;
    transition: 0.5s;
}
</style>
