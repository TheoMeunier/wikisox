<div>
    <x-modules.modal.modal-content>
        <x-slot name="title">
            <h3>{{ __('title.restore') }}</h3>
        </x-slot>

        <x-slot name="content">
            <div>
                <p class="text-center">{{ __('modals.logs.restore') }}</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-buttons.button-secondary wire:click.prevent="$emit('closeModal')">
                {{ __('button.action.close') }}
            </x-buttons.button-secondary>
            <x-buttons.primary-button wire:click.prevent="restore">
                {{ __('button.action.restore') }}
            </x-buttons.primary-button>
        </x-slot>
    </x-modules.modal.modal-content>
</div>
