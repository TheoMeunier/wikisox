<div>
    <div class="form__btn__input">
        <div id="btn-open-filemanager" class="card p-5 w-full" style="min-height: 250px; max-height: 250px">
            <x-input id="input-image-filemanager" class="block mt-1 w-full" name="{{ $name }}" value="{{ $value }}"/>
            <img
                    id="img-filemanager"
                    class="mx-auto"
                    style="min-width: 315px; max-width: 315px; height: 200px"
                    src="{{ $value !== null ? $value : ''}}"
                    alt="download"
            />
        </div>
    </div>

    <file-manager endpoint="/api" hidden></file-manager>
</div>
