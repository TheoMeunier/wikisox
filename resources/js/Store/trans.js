import { defineStore } from 'pinia'
import axios from 'axios'

export const useTransStore = defineStore('trans', {
    state: () => {
        return {
            i18n: {},
        }
    },

    getters: {
        loaded: state => Object.keys(state.i18n).length !== 0,
    },

    actions: {
        async loadi18n() {
            if (Object.keys(this.i18n).length !== 0) throw new Error('i18n ERROR')
            await axios.get('/webapi/trans').then(response => this.storeLang(response.data))
        },

        storeLang(payload) {
            this.i18n = payload
        },

        clear() {
            this.$reset()
        },
    },
})
