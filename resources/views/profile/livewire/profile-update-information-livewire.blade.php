<div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-forms.label for="name" :value="__('input.label.name')"/>
            <x-forms.input wire:model.defer="name" class="w-full" type="text"/>
            <x-forms.error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-forms.label for="email" :value="__('input.label.email')"/>
            <x-forms.input wire:model.defer="email" class="w-full" type="email"/>
            <x-forms.error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </div>
    <div class="flex justify-end mt-3">
        <x-buttons.primary-button wire:click.prevent="updateInformation()">
            {{ __('button.action.edit') }}
        </x-buttons.primary-button>
    </div>
</div>
