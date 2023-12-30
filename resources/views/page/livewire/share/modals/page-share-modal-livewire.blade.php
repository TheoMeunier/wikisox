<div>
    <x-modules.modal.modal-content>
        <x-slot name="title">
            <h3>{{ __('title.page.share') }}</h3>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-forms.label for="name" :value="__('input.label.link')"/>
                    <x-forms.input id="share-page-input" wire:model.defer="link" class="w-full" type="text"/>
                </div>
                <div>
                    <x-forms.label for="name" :value="__('input.label.time')"/>
                    <x-forms.select wire:model.defer="hour" class="w-full">
                        <option value="1">1 h</option>
                        <option value="6">6 h</option>
                        <option value="12">12 h</option>
                        <option value="24">24 h</option>
                        <option value="48">48 h</option>
                    </x-forms.select>
                    <x-forms.error :messages="$errors->get('hour')" class="mt-2"/>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-buttons.button-secondary wire:click.prevent="$emit('closeModal')">
                {{ __('button.action.close') }}
            </x-buttons.button-secondary>
            <x-buttons.primary-button type="button" id="share-page-copy" wire:click.prevent="createShare">
                {{ __('button.action.copy') }}
            </x-buttons.primary-button>

            <script>
                document.getElementById('share-page-copy').addEventListener('click', function () {
                    let copyText = document.getElementById('share-page-input');
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    document.execCommand("copy");
                });
            </script>
        </x-slot>
    </x-modules.modal.modal-content>
</div>
