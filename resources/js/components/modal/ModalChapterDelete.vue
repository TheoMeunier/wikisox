<template>
    <Modal>
        <template v-slot:button_open>
            <button>
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </template>

        <template v-slot:title>{{ i18n.title.deleteChapter }} {{ chapter.name }} </template>

        <template v-slot:content>{{ i18n.modal.deleteChapter }}</template>

        <template v-slot:button_action>
            <button @click="deleteMyChapter(chapter.slug)" class="btn btn__danger">{{ i18n.button.delete }}</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '../modules/modal'
import useBooks from '../../services/booksService'
import lang from "../../services/tools/lang";
import useAdminChapter from "../../services/admin/AdminChaptersService";
const props = defineProps({
    chapter: {},
})

const { deleteChapter } = useAdminChapter()
const i18n = lang()

const deleteMyChapter = async slug => {
    await deleteChapter(slug)
}
</script>
