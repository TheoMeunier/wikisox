<div id="btn-open-filemanager" class="border border-gray-300 rounded-md cursor-pointer shadow-sm h-full min-w-full">
    <div>
        <x-input id="input-image-filemanager" class="hidden" name="{{ $name }}" value="{{ $value }}"/>
        <img
            id="img-filemanager"
            src="{{ $value == "" ? asset('images/donwload.svg') : $value }}"
            alt="download"
            class="object-fill h-48 min-w-full mx-auto"
        />
    </div>
</div>
