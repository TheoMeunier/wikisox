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
      <button class="btn__danger"
      >Supprimer
      </button>
    </template>
  </Modal>
</template>

<script setup>
import Modal from '../../modules/modal'
const props = defineProps({
  book: {},
})
</script>
