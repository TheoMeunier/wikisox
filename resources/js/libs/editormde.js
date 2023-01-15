import SimpleMDE from './simplemdeP'
import { copyImage } from './file-manager'

let simpleMDR = new SimpleMDE({
    element: document.getElementById('markdown-editor'),
    toolbar: [
        {
            name: 'bold',
            action: SimpleMDE.toggleBold,
            className: 'fa fa-bold',
            title: 'Bold',
        },
        {
            name: 'italic',
            action: SimpleMDE.toggleItalic,
            className: 'fa fa fa-italic',
            title: 'Italic',
        },
        {
            name: 'heading',
            action: SimpleMDE.toggleHeadingSmaller,
            className: 'fa fa-header',
            title: 'Heading',
        },
        '|',
        {
            name: 'code',
            action: SimpleMDE.toggleCodeBlock,
            className: 'fa fa-code',
            title: 'CodeBlock',
        },
        {
            name: 'quote',
            action: SimpleMDE.toggleBlockquote,
            className: 'fa fa-quote-left',
            title: 'QuoteBlock',
        },

        '|',
        {
            name: 'link',
            action: SimpleMDE.drawLink,
            className: 'fa fa-link',
            title: 'Link',
        },
        {
            name: 'image',
            action: SimpleMDE.drawImage,
            className: 'fa fa-picture-o',
            title: 'Image',
        },
        {
            id: 'IconFilemanager',
            name: 'uploadImage',
            action: copyImage,
            className: 'fa-solid fa-upload iconEM',
        },
        '|',
        {
            name: 'preview',
            action: SimpleMDE.togglePreview,
            className: 'fa fa-eye no-disable',
            title: 'Preview',
        },
        {
            name: 'side-by-side',
            action: SimpleMDE.toggleSideBySide,
            className: 'fa fa-columns no-disable no-mobile',
            title: 'sideBySide',
        },
        {
            name: 'fullscreen',
            action: SimpleMDE.toggleFullScreen,
            className: 'fa fa-arrows-alt no-disable no-mobile',
            title: 'fullScreen',
        },
    ],
})
