<div>
    <x-buttons.btn-link-primary wire:click.prevent="$emit('openModal', 'pages.modals.page-share-modal-livewire', {{ json_encode(['page' => $page]) }})">
        <x-icons.icon-share class="w-5 h-5"/>
        {{ __('button.page.share') }}
    </x-buttons.btn-link-primary>
</div>
