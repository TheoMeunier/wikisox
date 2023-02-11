import { ref } from 'vue'
import * as fr from '../../lang/fr'
import * as en from '../../lang/en'

export default function lang() {
    const lang = ref({})
    const trans = process.env.MIX_APP_LANG

    if (trans === 'fr') {
        lang.value = fr.data
    } else if (trans === 'en') {
        lang.value = en.data
    }

    return lang.value
}

lang()
