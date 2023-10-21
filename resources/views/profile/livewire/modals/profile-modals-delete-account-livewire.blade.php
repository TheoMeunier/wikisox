<div>
    <x-modules.modal.modal-content>
        <x-slot name="title">
            <h3>{{ __('title.profile.delete') }}</h3>
        </x-slot>

        <x-slot name="content">
            <div>
                <p>{{ __('modals.profile.delete.modal') }}</p>
            </div>

            <div>
                <x-forms.label for="password" :value="__('input.label.password')"/>
                <x-forms.input wire:model.defer="password" class="w-full" type="password"/>
                <x-forms.error :messages="$errors->get('password')" class="mt-2"/>
            </div>
        </x-slot>


        <x-slot name="footer">
            <x-buttons.button-secondary wire:click.prevent="$emit('closeModal')">
                {{ __('button.action.close') }}
            </x-buttons.button-secondary>
            <x-buttons.buttons-danger wire:click.prevent="delete()">
                {{ __('button.action.delete') }}
            </x-buttons.buttons-danger>
        </x-slot>
    </x-modules.modal.modal-content>
</div>
