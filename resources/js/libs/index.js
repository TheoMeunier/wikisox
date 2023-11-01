import './alphinejs'
import './file-manager'
import './markdown-editor'
import hljs from 'highlight.js'

hljs.highlightAll()

//avatar
let avatar_input = document.querySelector('#form__avatar input')
let avatar_img = document.querySelector('#form__avatar img')
let wrapper = document.querySelector('#wrapper__avatar_img')

if (avatar_input && wrapper) {
    avatar_input.addEventListener('change', async e => {
        const formData = new FormData()
        formData.append('avatar[]', e.target.files[0])

        let response = await axios.post('/webapi/profile/avatar', formData)

        if (avatar_img) {
            avatar_img.src = response.data.path
        } else {
            const newImage = new Image()
            newImage.src = response.data.path
            newImage.classList.add('object-contain')

            wrapper.replaceChildren(newImage)
        }
    })
}
