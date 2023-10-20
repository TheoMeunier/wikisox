<div class="markdown-editor">
    <div class="editor__toolbar">
        <div class="editor__toolbar__group">
            <div class="icon" id="bold">
                <x-icons.icon-bold class="h-5 w-5"/>
            </div>
            <div class="icon" id="italic">
                <x-icons.icon-italic class="h-5 w-5"/>
            </div>
            <div class="icon" id="strikethrough">
                <x-icons.icon-strikethrough class="h-5 w-5"/>
            </div>
            <div class="icon" id="code">
                <x-icons.icon-code class="h-5 w-5"/>
            </div>
            <div class="icon" id="link">
                <x-icons.icon-link class="h-5 w-5"/>
            </div>
            <div class="icon" id="image">
                <x-icons.icon-image class="h-5 w-5"/>
            </div>
        </div>
        <div id="preview" class="icon">
            <x-icons.icon-eyes class="h-5 w-5"/>
        </div>
    </div>
    <div id="input-output">
        <textarea id="input-area" name="{{ $name }}" rows="30" cols="50">{{ $value }}</textarea>
        <div id="output-area"></div>
    </div>
</div>

<file-manager endpoint="/api" hidden style="position: absolute; z-index: 2"></file-manager>
