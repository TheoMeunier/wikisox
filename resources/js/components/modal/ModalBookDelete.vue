<template>
    <Modal>
        <template v-slot:button_open>
            <button>
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </template>

        <template v-slot:title>{{ i18n.title.deleteBook }} {{ book.name }} </template>

        <template v-slot:content>{{ i18n.modal.deleteBook }}</template>

        <template v-slot:button_action>
            <button @click="deleteMyBook(book.slug)" class="btn btn__danger">{{ i18n.button.delete }}</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '../modules/modal'
import useBooks from '../../services/booksService'
import lang from '../../services/tools/lang'
import useAdminBook from '../../services/admin/AdminBooksService'
const props = defineProps({
    book: {},
})

const { deleteBook } = useAdminBook()
const i18n = lang()

const deleteMyBook = async slug => {
    await deleteBook(slug)
}
</script>
