<template>
    <Modal>
        <template v-slot:button_open>
            <button>
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </template>

        <template v-slot:title> Supprimer le livre {{ book.name }} </template>

        <template v-slot:content> Voulez vous vraiment supprimer ce page ? </template>

        <template v-slot:button_action>
            <button @click="deleteMyBook(book.slug)" class="btn__danger">Supprimer</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '../modules/modal'
import useBooks from '../../services/booksService'
const props = defineProps({
    book: {},
})

const { deleteBook } = useBooks()

const deleteMyBook = async slug => {
    await deleteBook(slug)
}
</script>
