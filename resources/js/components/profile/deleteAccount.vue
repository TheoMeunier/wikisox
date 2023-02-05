<template>
    <Modal>
        <template v-slot:button_open>
            <button class="btn btn__danger">
                Supprimer mon compte
            </button>
        </template>

        <template v-slot:title> Supprimer mon compte </template>

        <template v-slot:content> Voulez vous vraiment supprimer votre compte ? </template>

        <template v-slot:button_action>
            <button @click="" class="btn btn__danger">Supprimer</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '../modules/modal'
</script>
