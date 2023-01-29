import {FileManager} from 'filemanager-element';
import 'filemanager-element/FileManager.css'

// -------------------------------------------
// DEFAULT INPUT AND OUTPUT AREA
let textarea = document.querySelector('#input-area');
let outputArea = document.querySelector('#output-area');
let previewMessage = document.querySelector('.preview-message');

// -------------------------------------------
// TOOLBAR
// -------------------------------------------
const preview = document.querySelector('#preview');
const boldButton = document.querySelector('#bold');
const italicButton = document.querySelector('#italic');
const codeButton = document.querySelector('#code');
const strikethroughButton = document.querySelector(' #strikethrough')
const linkButton = document.querySelector('#link');


if (preview) {
    preview.addEventListener('click', () => {
        output(parse(textarea.value));

        outputArea.classList.toggle('show');
        previewMessage.classList.toggle('show');
        preview.classList.toggle('active');
    });
}

if (boldButton) {
    boldButton.addEventListener('click', () =>
        insertText(textarea, '****', 'demo', 2, 6)
    );
}

if (italicButton) {
    italicButton.addEventListener('click', () =>
        insertText(textarea, '**', 'demo', 1, 5)
    );
}


if (codeButton) {
    codeButton.addEventListener('click', () =>
        insertText(textarea, '``````', 'demo', 3, 7)
    );
}

if (strikethroughButton) {
    strikethroughButton.addEventListener('click', () => {
        insertText(textarea, '~~', 'demo', 2, 6)
    });
}


if (linkButton) {
    linkButton.addEventListener('click', () =>
        insertText(textarea, '[](http://...)', 'url text', 1, 9)
    );
}


// -------------------------------------------

function setInputArea(inputElement) {
    textarea = inputElement;
}

function setOutputArea(outputElement) {
    outputArea = outputElement;
}

function insertText(textarea, syntax, placeholder = '', selectionStart = 0, selectionEnd = 0) {
    // Current Selection
    const currentSelectionStart = textarea.selectionStart;
    const currentSelectionEnd = textarea.selectionEnd;
    const currentText = textarea.value;

    if (currentSelectionStart === currentSelectionEnd) {
        const textWithSyntax = textarea.value = currentText.substring(0, currentSelectionStart) + syntax + currentText.substring(currentSelectionEnd);
        textarea.value = textWithSyntax.substring(0, currentSelectionStart + selectionStart) + placeholder + textWithSyntax.substring(currentSelectionStart + selectionStart)

        textarea.focus();
        textarea.selectionStart = currentSelectionStart + selectionStart;
        textarea.selectionEnd = currentSelectionEnd + selectionEnd;
    } else {
        const selectedText = currentText.substring(currentSelectionStart, currentSelectionEnd);
        const withoutSelection = currentText.substring(0, currentSelectionStart) + currentText.substring(currentSelectionEnd);
        const textWithSyntax = withoutSelection.substring(0, currentSelectionStart) + syntax + withoutSelection.substring(currentSelectionStart);

        // Surround selected text
        textarea.value = textWithSyntax.substring(0, currentSelectionStart + selectionStart) + selectedText + textWithSyntax.substring(currentSelectionStart + selectionStart);

        textarea.focus();
        textarea.selectionEnd = currentSelectionEnd + selectionStart + selectedText.length;
    }
}

function output(lines) {
    outputArea.innerHTML = lines;
}

// -------------------------------------------
// PARSER
// -------------------------------------------

function parse(content) {
    // Regular Expressions
    const h1 = /^#{1}[^#].*$/gm;
    const h2 = /^#{2}[^#].*$/gm;
    const h3 = /^#{3}[^#].*$/gm;
    const bold = /\*\*[^\*\n]+\*\*/gm;
    const italics = /[^\*]\*[^\*\n]+\*/gm;
    const link = /\[[\w|\(|\)|\s|\*|\?|\-|\.|\,]*(\]\(){1}[^\)]*\)/gm;
    const lists = /^((\s*((\*|\-)|\d(\.|\))) [^\n]+))+$/gm;
    const unorderedList = /^[\*|\+|\-]\s.*$/;
    const unorderedSubList = /^\s\s\s*[\*|\+|\-]\s.*$/;
    const orderedList = /^\d\.\s.*$/;
    const orderedSubList = /^\s\s+\d\.\s.*$/;

    // Example: # Heading 1
    if (h1.test(content)) {
        const matches = content.match(h1);

        matches.forEach(element => {
            const extractedText = element.slice(1);
            content = content.replace(element, '<h1>' + extractedText + '</h1>');
        });
    }

    // Example: # Heading 2
    if (h2.test(content)) {
        const matches = content.match(h2);

        matches.forEach(element => {
            const extractedText = element.slice(2);
            content = content.replace(element, '<h2>' + extractedText + '</h2>');
        });
    }

    // Example: # Heading 3
    if (h3.test(content)) {
        const matches = content.match(h3);

        matches.forEach(element => {
            const extractedText = element.slice(3);
            content = content.replace(element, '<h3>' + extractedText + '</h3>');
        });
    }

    // Example: **Bold**
    if (bold.test(content)) {
        const matches = content.match(bold);

        matches.forEach(element => {
            const extractedText = element.slice(2, -2);
            content = content.replace(element, '<strong>' + extractedText + '</strong>');
        });
    }

    // Example: *Italic*
    if (italics.test(content)) {
        const matches = content.match(italics);

        matches.forEach(element => {
            const extractedText = element.slice(2, -1);
            content = content.replace(element, ' <em>' + extractedText + '</em>');
        });
    }

    // Example: [I'm an inline-style link](https://www.google.com)
    if (link.test(content)) {
        const links = content.match(link);

        links.forEach(element => {
            const text = element.match(/^\[.*\]/)[0].slice(1, -1);
            const url = element.match(/\]\(.*\)/)[0].slice(2, -1);

            content = content.replace(element, '<a href="' + url + '">' + text + '</a>');
        });
    }

    if (lists.test(content)) {
        const matches = content.match(lists);

        matches.forEach(list => {
            const listArray = list.split('\n');

            const formattedList = listArray.map((currentValue, index, array) => {
                if (unorderedList.test(currentValue)) {
                    currentValue = '<li>' + currentValue.slice(2) + '</li>';

                    if (!unorderedList.test(array[index - 1]) && !unorderedSubList.test(array[index - 1])) {
                        currentValue = '<ul>' + currentValue;
                    }

                    if (!unorderedList.test(array[index + 1]) && !unorderedSubList.test(array[index + 1])) {
                        currentValue = currentValue + '</ul>';
                    }

                    if (unorderedSubList.test(array[index + 1]) || orderedSubList.test(array[index + 1])) {
                        currentValue = currentValue.replace('</li>', '');
                    }
                }

                if (unorderedSubList.test(currentValue)) {
                    currentValue = currentValue.trim();
                    currentValue = '<li>' + currentValue.slice(2) + '</li>';

                    if (!unorderedSubList.test(array[index - 1])) {
                        currentValue = '<ul>' + currentValue;
                    }

                    if (!unorderedSubList.test(array[index + 1]) && unorderedList.test(array[index + 1])) {
                        currentValue = currentValue + '</ul></li>';
                    }

                    if (!unorderedSubList.test(array[index + 1]) && !unorderedList.test(array[index + 1])) {
                        currentValue = currentValue + '</ul></li></ul>';
                    }
                }

                if (orderedList.test(currentValue)) {
                    currentValue = '<li>' + currentValue.slice(2) + '</li>';

                    if (!orderedList.test(array[index - 1]) && !orderedSubList.test(array[index - 1])) {
                        currentValue = '<ol>' + currentValue;
                    }

                    if (!orderedList.test(array[index + 1]) && !orderedSubList.test(array[index + 1]) && !orderedList.test(array[index + 1])) {
                        currentValue = currentValue + '</ol>';
                    }

                    if (unorderedSubList.test(array[index + 1]) || orderedSubList.test(array[index + 1])) {
                        currentValue = currentValue.replace('</li>', '');
                    }
                }

                if (orderedSubList.test(currentValue)) {
                    currentValue = currentValue.trim();
                    currentValue = '<li>' + currentValue.slice(2) + '</li>';

                    if (!orderedSubList.test(array[index - 1])) {
                        currentValue = '<ol>' + currentValue;
                    }

                    if (orderedList.test(array[index + 1]) && !orderedSubList.test(array[index + 1])) {
                        currentValue = currentValue + '</ol>';
                    }

                    if (!orderedList.test(array[index + 1]) && !orderedSubList.test(array[index + 1])) {
                        currentValue = currentValue + '</ol></li></ol>';
                    }
                }

                return currentValue;
            }).join('');

            console.log(formattedList);
            content = content.replace(list, formattedList);
        });
    }

    return content.split('\n').map(line => {
        if (!h1.test(line) && !h2.test(line) && !h3.test(line) && !unorderedList.test(line) && !unorderedSubList.test(line) && !orderedList.test(line) && !orderedSubList.test(line)) {
            return line.replace(line, '<p>' + line + '</p>');
        }
    }).join('');
}

// -------------------------------------------
// FILE MANAGER
// -------------------------------------------
const fileManager = document.querySelector('file-manager');
const image = document.querySelector('#image');

if (image) {
    image.addEventListener('click', () => {
            fileManager.removeAttribute('hidden');
        }
    );
}

// add image
if (fileManager) {
    fileManager.addEventListener('selectfile', e => {
        const syntax = '![' + e.detail.url + '](' + e.detail.url + ')';
        insertText(textarea, syntax)

        fileManager.setAttribute('hidden', '')
    })

    // Close filemanager
    fileManager.addEventListener('close', () => {
        fileManager.setAttribute('hidden', '')
    })
}

FileManager.register();
