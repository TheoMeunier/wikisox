<div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-forms.label for="password" :value="__('input.label.password')"/>
            <x-forms.input wire:model.defer="password" class="w-full" type="password"/>
            <x-forms.error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div>
            <x-forms.label for="confirm-password" :value="__('input.label.confirm-password')"/>
            <x-forms.input wire:model.defer="password_confirmation" class="w-full" type="password"/>
            <x-forms.error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
    </div>
    <div class="flex justify-end mt-3">
        <x-buttons.primary-button wire:click.prevent="updatePassword()">
            {{ __('button.action.edit') }}
        </x-buttons.primary-button>
    </div>
</div>
