<template>
    <div class="grid grid-cols-4 my-8">
        <div class="col-span-1  px-5 border-r-2 border-gray-200">
            <div class="pb-9 border-b-2 border-gray-200">
                <form class="input__icon ">
                    <div class="input__icon__icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input v-model="search"
                           type="text"
                           class="input__icon__input w-64"
                           id="example-search-input"
                           @keyup="files = searchImage(search, selectFolder, folders['root']?.files)"
                           :placeholder="i18n.search"
                    />
                </form>
            </div>

            <div class="mt-8">
                <div class="folder flex justify-between items-center text-xl text-gray-500  px-2"
                    :class="selectFolder === null ? 'active' : ''">
                    <div class="py-1" @click.prevent="getFiles(null)">
                        <i class="fa-solid fa-folder-open"></i>
                        /
                    </div>
                    <i class="fa-solid fa-plus" @click="addFolder()"></i>
                </div>

                <div class="ml-7">
                    <slot v-for="folder in folders" :key="folder.id">
                        <div class="folder flex justify-between items-center text-xl text-gray-500 mt-1 px-2"
                             :class="(selectFolder && selectFolder.name === folder.name) ? 'active' : ''">
                            <slot v-if="folder.id !== null">
                                <div class="py-1" @click.prevent="getFiles(folder)">
                                    <i class="fa-solid fa-folder-open"></i>
                                    {{ folder.name }}
                                </div>
                                <i class="fa-solid fa-plus"></i>
                            </slot>
                            <slot v-else>
                                <div class="py-1 flex items-center gap-4">
                                    <i class="fa-solid fa-folder-open"></i>
                                    <input type="text" class="form-control" v-model="newFolder.name" required>
                                </div>

                                <i class="fa-solid fa-arrow-right" @click.stop="createNewFolder"></i>
                            </slot>
                        </div>
                    </slot>
                </div>
            </div>
        </div>

        <div class="relative col-span-3 px-6"
             @dragleave.prevent="dragLeave($event)"
             @dragover.prevent="dragOver($event)"
             @drop.prevent="drop($event)"
        >
            <div class="flex justify-start flex-wrap gap-5" :class="!files.length ? 'h-full' : ''">
                <slot v-if="files.length" v-for="file in files" :key="file.id">
                    <div class="relative p-2 border-2 border-gray-200 rounded-lg group w-36 h-50">
                        <div @click.prevent="removeFile(file)" class="text-red-500 -top-4 -right-3 absolute cursor-pointer text-2xl opacity-0 group-hover:opacity-100 transition duration-300">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </div>
                        <img class="w-32 h-32" :src="file.url" alt="">
                        <p class="text-center mt-2 text-lg break-all">{{ file.name.substring(0, 20) }}</p>
                    </div>
                </slot>

                <slot v-else>
                    <div class="w-full flex justify-center items-center flex-col text-gray-400">
                        <p class="text-2xl py-3">{{ i18n.filemanager.emptyFolder }}</p>
                        <p class="text-xl py-4">{{ i18n.filemanager.uploadFile }}<i class="fa-solid fa-file-arrow-down ml-2"></i></p>
                        <button class="btn btn__danger" v-if="selectFolder && !search.length" @click.prevent="removeMyFolder">{{ i18n.filemanager.buttonDeleteFolder }}</button>
                    </div>
                </slot>
            </div>

            <div class="dropzone__file" :class="over === true ? 'active' : ''">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
        </div>
    </div>
</template>

<script setup>

import {onMounted, reactive, ref} from "vue";
import useAdminImage from "../../services/admin/filemanager/AdminImagesService";
import useDropAndDrop from "../../services/admin/filemanager/DrapAndDrop";
import searchImage from "../../services/admin/filemanager/SearchImage";
import lang from "../../services/tools/lang";

const {folders, files, getFolders, createFolder, uploadFile ,addFileToFolder, removeFolder, removeFile} = useAdminImage()
const {dragOver, dragLeave, over} = useDropAndDrop()
const i18n = lang()

onMounted(() => {
    getFolders()
    getFiles(null)
});

const newFolder = reactive({
    name: '',
})
const search = ref('')
const selectFolder = ref(null)

const getFiles = async (folder) => {
    await addFileToFolder(folder)
    selectFolder.value = folder
}

const addFolder = async () => {
    folders.value.unshift({
        id: null,
        name: null,
        parent: null,
    })
}

const createNewFolder = async () => {
   if (newFolder.name) {
       await createFolder({...newFolder})
       newFolder.name = ''
   } else {
       folders.value.shift()
   }
}

const removeMyFolder = async () => {
    if (confirm('Voulez vous vraiment supprimer de dossier')) {
        await removeFolder(selectFolder.value)
        selectFolder.value = null
        files.value = folders.value['root'].files
    }
}

const drop = (e) => {
    e.preventDefault()
    Array.from(e.dataTransfer.files).forEach(async (file) => {
        await uploadFile(file, selectFolder.value)
    });

    over.value = false
}
</script>

<style>
.folder.active {
    @apply bg-indigo-100 rounded-lg text-indigo-500 cursor-pointer;
}

.folder:hover {
    @apply bg-indigo-100 rounded-lg text-indigo-500 cursor-pointer;
}

.dropzone__file {
    pointer-events: none;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    transition: opacity 0.3s;
    color: #fff;
}

.dropzone__file::before, .dropzone__file::after{
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.dropzone__file::after {
    margin: 10px;
    border-radius: 4px;
    @apply border-dashed border-2 border-indigo-500
}

.dropzone__file::before {
    @apply bg-indigo-400;
    opacity: 0.6;
}

.active {
    opacity: 1;
}
</style>
