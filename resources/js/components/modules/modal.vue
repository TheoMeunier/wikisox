<template>
    <div @click="isOpen = true" type="button">
        <slot name="button_open" />
    </div>
    <div v-show="isOpen" class="modal">
        <div class="card" :class="sizeModal">
            <div class="card__body">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl">
                        <slot name="title" />
                    </h3>
                    <div @click="isOpen = false" class="btn__icon">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="mb-4 text-sm text-center">
                        <slot name="content" />
                    </p>
                </div>

                <div class="card__footer flex justify-end">
                    <button @click="isOpen = false" class="btn btn__secondary mr-2">Close</button>
                    <slot name="button_action" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
const props = defineProps({
    sizeModal: {
        type: String,
        default: 'w-1/4',
    },
})
const isOpen = ref(false)
</script>
