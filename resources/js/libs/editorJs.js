import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import NestedList from '@editorjs/nested-list';
import SimpleImage from '@editorjs/simple-image';
import Quote from '@editorjs/quote';
import CodeTool from '@editorjs/code';
import Warning from '@editorjs/warning';
import InlineCode from '@editorjs/inline-code';
import Paragraph from '@editorjs/paragraph';

const editor_data = document.getElementById('editor_data')
const form_page = document.getElementById('form_page')
const editorjs = document.getElementById('editorjs')
let editor

if (editorjs) {
    editor = new EditorJS({
        /**
         * Id of Element that should contain the Editor
         */
        holder: 'editorjs',
        autofocus: true,

        /**
         * onReady callback
         */
        onReady: () => {
           const json = JSON.parse(editor_data.value)

            json.blocks.forEach(block => {
                editor.blocks.insert(block.type, block.data)
            })
        },

        /**
         * Available Tools list.
         * Pass Tool's class or Settings object for each Tool you want to use
         */
        tools: {
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            header: {
                class: Header,
                inlineToolbar: true,
                config: {
                    placeholder: 'Enter a header',
                    level: [2, 3, 4],
                    defaultLevel: 3
                }
            },
            list: {
                class: NestedList,
                inlineToolbar: true,
                config: {
                    defaultStyle: 'ordered'
                },
            },
            warning: {
                class: Warning,
                inlineToolbar: true,
                config: {
                    titlePlaceholder: 'Title',
                    messagePlaceholder: 'Message',
                },
            },
            image: {
                class: SimpleImage,
                inlineToolbar: true
            },
            code: {
                class: CodeTool,
                inlineToolbar: true
            },
            inlineCode: {
                class: InlineCode,
            },
            quote: {
                class: Quote,
                inlineToolbar: true,
            }
        },

        /**
         * Previously saved data that should be rendered
         */
        data: {}
    });
}

if (form_page) {
    form_page.addEventListener('submit', (e) => {
        e.preventDefault()

        editor.save().then((outputData) => {
            editor_data.value = JSON.stringify(outputData)
            form_page.submit()
        }).catch((error) => {
            console.log(error)
        });
    });
}
