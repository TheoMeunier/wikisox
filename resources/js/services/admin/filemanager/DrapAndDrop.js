import {ref} from "vue";

export default function useDropAndDrop() {
    const over = ref(false)

    const dragLeave = (e) => {
        e.preventDefault()
        over.value = false
    }

    const dragOver = (e) => {
        e.preventDefault()
        over.value = true
    }

    return {over, dragLeave, dragOver}
}
