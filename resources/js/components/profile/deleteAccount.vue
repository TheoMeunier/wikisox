<template>
    <Modal>
        <template v-slot:button_open>
            <button class="btn btn__danger">
                {{ i18n.button.deleteAccount }}
            </button>
        </template>

        <template v-slot:title>{{ i18n.title.deleteAccount }}</template>

        <template v-slot:content>{{ i18n.modal.deleteAccount }}</template>

        <template v-slot:button_action>
            <button @click="" class="btn btn__danger">{{ i18n.button.delete }}</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '../modules/modal'
import lang from '../../services/tools/lang'

const i18n = lang()
</script>
