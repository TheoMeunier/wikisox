<div>
    <div>
        <div class="w-2/3">
            <p>{{ __('modals.profile.delete.shur') }}</p>
            <p>{{ __('modals.profile.delete.confirmation') }}</p>
        </div>

        <div class="mt-4 flex justify-end">
            <x-buttons.buttons-danger
                wire:click.prevent="$emit('openModal', 'profile.modals.profile-modals-delete-account-livewire')"
                type="button"
            >
                {{ __('button.action.delete-account') }}
            </x-buttons.buttons-danger>
        </div>
    </div>
</div>
