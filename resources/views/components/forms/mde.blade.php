<div id="markdown-editor">
    <div class="toolbar">
        <div class="group">
            <div class="icon" id="bold"><i class="fa fa-bold"></i></div>
            <div class="icon" id="italic"><i class="fa fa-italic"></i></div>
            <div class="icon" id="strikethrough"><i class="fa-solid fa-strikethrough"></i></div>
            <div class="icon" id="code"><i class="fa-solid fa-code"></i></div>
            <div class="icon" id="link"><i class="fa fa-link"></i></div>
            <div class="icon" id="image"><i class="fa fa-image" ></i></div>
        </div>
        <div id="preview" class="icon"><i class="fa-solid fa-eye"></i></div>
    </div>
    <div id="input-output">
        <textarea id="input-area" name="{{ $name }}" rows="30" cols="50">{{ $value }}</textarea>
        <div id="output-area"></div>
        <p class="preview-message prose">Preview Mode</p>
    </div>
</div>

<file-manager endpoint="/api" hidden style="position: absolute; z-index: 2"></file-manager>
