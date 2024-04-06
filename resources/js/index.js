import './libs/alphinejs'
import './libs/file-manager'
import './libs/markdown-editor'
import hljs from 'highlight.js'
import axios from 'axios'

hljs.highlightAll()

// copy code snippet
let snippets = document.getElementsByTagName('pre');
let numberOfSnippets = snippets.length;

if (snippets) {
    for (let i = 0; i < numberOfSnippets; i++) {
        let code = snippets[i].getElementsByTagName('code')[0].innerText;
        snippets[i].classList.add('hljs'); // append copy button to pre tag
        snippets[i].innerHTML = '<button class="hljs-copy">Copy</button>' + snippets[i].innerHTML; // append copy button

        snippets[i].getElementsByClassName('hljs-copy')[0].addEventListener("click", function () {
            this.innerText = 'Copying..';
            if (!navigator.userAgent.toLowerCase().includes('safari')) {
                navigator.clipboard.writeText(code);
            } else {
                prompt("Clipboard (Select: ⌘+a > Copy:⌘+c)", code);
            }

            this.innerText = 'Copied!';

            let button = this;
            setTimeout(function () {
                button.innerText = 'Copy';
            }, 1000)

        });

    }
}

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
