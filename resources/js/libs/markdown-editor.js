import CodeMirror from 'codemirror'
import 'codemirror/lib/codemirror.css'
import 'codemirror/mode/markdown/markdown.js'
import 'codemirror/theme/neo.css'
import showdown from 'showdown'
import { FileManager } from 'filemanager-element'
import showdownHighlight from 'showdown-highlight'

// -------------------------------------------
// DEFAULT INPUT AND OUTPUT AREA
//
let textarea = document.querySelector('#input-area')
let output = document.querySelector('#output-area')

// -------------------------------------------
// TOOLBAR
// -------------------------------------------
const boldButton = document.querySelector('#bold')
const italicButton = document.querySelector('#italic')
const codeButton = document.querySelector('#code')
const linkButton = document.querySelector('#link')
const previewButton = document.querySelector('#preview')
const alertbutton = document.querySelector('#alert')

// -------------------------------------------
// FILE MANAGER
// -------------------------------------------
const fileManager = document.querySelector('file-manager')
const image = document.querySelector('#image')

if (image) {
    image.addEventListener('click', () => {
        fileManager.removeAttribute('hidden')
    })
}

// -------------------------------------------
// CodeMirror
// -------------------------------------------
if (textarea) {
    const editor = CodeMirror.fromTextArea(textarea, {
        mode: 'markdown',
        theme: 'neo',
        lineNumbers: false,
        lineWrapping: true,
        cursorBlinkRate: 500,
    })

    // -------------------------------------------
    // Preview
    // -------------------------------------------

    const converser = new showdown.Converter({
        extensions: [
            showdownHighlight({
                // Whether to add the classes to the <pre> tag, default is false
                pre: true,
                auto_detection: true,
            }),
        ],
    })

    if (previewButton) {
        previewButton.addEventListener('click', e => {
            e.preventDefault()
            output.classList.toggle('show')
            previewButton.classList.toggle('active')

            output.innerHTML = converser.makeHtml(editor.getValue())
        })

        if (boldButton) {
            boldButton.addEventListener('click', () => {
                if (editor.getSelection() !== '') {
                    editor.replaceSelection('**' + editor.getSelection() + '**')
                    editor.focus()
                } else {
                    editor.replaceSelection('**demo**')
                    editor.focus()
                }
            })
        }

        if (italicButton) {
            italicButton.addEventListener('click', () => {
                if (editor.getSelection() !== '') {
                    editor.replaceSelection('*' + editor.getSelection() + '*')
                    editor.focus()
                } else {
                    editor.replaceSelection('*demo*')
                    editor.focus()
                }
            })
        }

        if (codeButton) {
            codeButton.addEventListener('click', () => {
                editor.replaceSelection('```\nYour code\n```')
                editor.focus()
            })
        }

        if (linkButton) {
            linkButton.addEventListener('click', () => {
                editor.replaceSelection('[](http://...)', editor.getCursor())
                editor.focus()
            })
        }
    }

    // add image
    if (fileManager) {
        fileManager.addEventListener('selectfile', e => {
            let syntax = null

            if (e.detail.folder !== null) {
                syntax = '![' + e.detail.name + '](' + e.detail.folder + '/' + e.detail.name + ')'
            } else {
                syntax = '![' + e.detail.name + '](' + e.detail.name + ')'
            }

            editor.replaceSelection(syntax)
            editor.focus()

            fileManager.setAttribute('hidden', '')
        })

        fileManager.addEventListener('close', () => {
            fileManager.setAttribute('hidden', '')
        })
    }

    // add alert
    if (alertbutton) {
        alertbutton.addEventListener('click', () => {
            editor.replaceSelection(':::warning\n\n:::')
            editor.focus()
        })
    }
}

FileManager.register()
