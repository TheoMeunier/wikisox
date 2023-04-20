<template>
    <div id="toast-success" class="alert" v-show="props.show">
        <div class="alert__icon">
            <slot v-if="props.type === 'success'">
                <IconSuccess />
            </slot>

            <slot v-else>
                <IconError />
            </slot>
        </div>
        <div class="alert__content">{{ props.message }}</div>
        <button type="button" class="alert__close" @click.prevent="store.closeAlert(props.index)" aria-label="Close">
            <IconClose />
        </button>
    </div>
</template>

<script setup>
import IconSuccess from '../Icons/IconSuccess.vue'
import IconError from '../Icons/IconError.vue'
import { useAlertStore } from '../../store/AlertStore.js'
import IconClose from '../Icons/IconClose.vue'

const store = useAlertStore()
const props = defineProps({
    type: String,
    message: String,
    show: Boolean,
    index: Number,
})
</script>
