<template>
    <div class="alerts__wrapper">
        <slot v-for="(notification, index) in store.notifications">
            <Alert :type="notification.type" :message="notification.message" :show="notification.show" :index="index" />
        </slot>
    </div>
</template>

<script setup>
import Alert from './Alert.vue'
import { useAlertStore } from '../../store/AlertStore.js'

const store = useAlertStore()
</script>
