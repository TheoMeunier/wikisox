import { FileManager } from 'filemanager-element'
import 'filemanager-element/FileManager.css'

const filemanager = document.querySelector('file-manager'),
    btnopen = document.querySelector('#btn-open-filemanager'),
    inputImage = document.querySelector('#input-image-filemanager'),
    image = document.querySelector('#img-filemanager'),
    sleep = ms => new Promise(r => setTimeout(r, ms))

let imageSelected = null,
    isFilemanagerOpen = false

if (btnopen) {
    btnopen.addEventListener('click', e => {
        filemanager.removeAttribute('hidden')
    })
}

if (filemanager) {
    filemanager.addEventListener('close', e => {
        if (null !== btnopen) {
            btnopen.classList.remove('d-none')
        }
        filemanager.setAttribute('hidden', '')
        isFilemanagerOpen = false
    })

    filemanager.addEventListener('selectfile', e => {
        if (null !== inputImage) {
            inputImage.value = e.detail.url
            image.src = e.detail.url
        } else {
        }

        if (null !== btnopen) {
            btnopen.classList.remove('d-none')
        }

        filemanager.setAttribute('hidden', '')
        isFilemanagerOpen = false
    })
}

async function myImage() {
    if (false === isFilemanagerOpen && null === imageSelected) {
        return null
    }

    if (null === imageSelected) {
        await sleep(50)
        return myImage()
    }

    return imageSelected
}

export async function copyImage(editor) {
    let cm = editor.codemirror,
        selectedText = cm.getSelection()

    filemanager.removeAttribute('hidden')
    isFilemanagerOpen = true

    const Image = await myImage()

    if (undefined !== Image) {
        cm.replaceSelection('![' + (selectedText || Image.name) + '](' + Image.url + ')')
    }

    imageSelected = null
}

FileManager.register()
