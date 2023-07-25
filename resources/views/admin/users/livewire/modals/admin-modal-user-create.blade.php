<div>
    <x-modules.modal.modal-content>
        <x-slot name="title">
            <h3>{{ __('title.user.create') }}</h3>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <x-forms.label for="name" :value="__('input.label.name')"/>
                    <x-forms.input wire:model.defer="name" class="w-full" type="text" placeholder="Nom"/>
                    <x-forms.error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-forms.label for="email" :value="__('input.label.email')"/>
                    <x-forms.input wire:model.defer="email" class="w-full" type="email" placeholder="Email"/>
                    <x-forms.error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 mt-3">
                <div>
                    <x-forms.label for="password" :value="__('input.label.password')"/>
                    <x-forms.input wire:model.defer="password" class="w-full" type="password"
                                         placeholder="password"/>
                    <x-forms.error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-forms.label for="confirm-password" :value="__('input.label.confirm-password')"/>
                    <x-forms.input wire:model.defer="password_confirmation" class="w-full" type="password"
                                         placeholder="confirm password"/>
                    <x-forms.error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
            <x-buttons.primary-button wire:click.prevent="save()">
                {{ __('button.action.create') }}
            </x-buttons.primary-button>
        </x-slot>
    </x-modules.modal.modal-content>
</div>
