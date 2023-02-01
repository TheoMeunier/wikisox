<template>
    <a @click="like" :class="data.like !== false ? 'text-yellow-400' : 'text-gray-500'" style="cursor: pointer">
        <i class="fa-star mr-2" :class="data.like !== false ? 'fa-solid' : 'fa-regular'"></i>

        <slot v-if="text === true">
            <slot v-if="data.like === true">dislike</slot>
            <slot v-else>like</slot>
        </slot>
    </a>
</template>

<script setup>
import { data } from 'autoprefixer'

const props = defineProps({
    data: {},
    params: String,
    text: {
        default: false,
        type: Boolean,
    },
})

const like = async () => {
    /*try {
        await axios.post('/webapi/' + props.params + '/like/' + props.data.id)
    } catch (e) {
        console.log(e)
    }*/
}
</script>
