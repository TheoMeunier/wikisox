<template>
    <Modal>
        <template v-slot:button_open>
            <button>
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </template>

        <template v-slot:title>{{ i18n.title.deletePage }} {{ page.name }} </template>

        <template v-slot:content>{{ i18n.modal.deletePage }}</template>

        <template v-slot:button_action>
            <button @click="deleteMyPage(page.slug)" class="btn btn__danger">{{ i18n.button.delete }}</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '../../modules/modal'
import lang from '../../../services/tools/lang'
import useAdminPage from '../../../services/admin/AdminPagesService'

const props = defineProps({
    page: {},
})

const { deletePage } = useAdminPage()
const i18n = lang()
const deleteMyPage = async slug => {
    await deletePage(slug)
}
</script>
