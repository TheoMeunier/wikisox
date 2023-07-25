<x-modules.modal.modal-content>
    <x-slot name="title">
        <h3>{{ __('title.user.edit') }}</h3>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <x-forms.label for="name" :value="__('input.label.name')"/>
                <x-forms.input wire:model.defer="user.name" class="w-full" type="text" placeholder="Nom"/>
                <x-forms.error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-forms.label for="email" :value="__('input.label.email')"/>
                <x-forms.input wire:model.defer="user.email" class="w-full" type="email" placeholder="Email"/>
                <x-forms.error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="mt-3">
            <x-forms.label for="role" :value="__('input.label.roles')"/>
            <x-forms.select wire:model.defer="role_id" class="w-full">
                <option selected>-- Open this select menu --</option>
                @foreach($roles as $k => $v)
                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                @endforeach
            </x-forms.select>
            <x-forms.error :messages="$errors->get('role_id')" class="mt-2" />
        </div>
    </x-slot>


    <x-slot name="footer">
        <x-buttons.button-secondary wire:click.prevent="$emit('closeModal')">
            {{ __('button.action.close') }}
        </x-buttons.button-secondary>
        <x-buttons.primary-button wire:click.prevent="update()">
            {{ __('button.action.edit') }}
        </x-buttons.primary-button>
    </x-slot>
</x-modules.modal.modal-content>
