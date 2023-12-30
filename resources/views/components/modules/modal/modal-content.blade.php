<div class="w-full">
    <div class="w-full flex justify-between items-center p-5">
        {{ $title }}
        <button wire:click.prevent="$emit('closeModal')" class="text-gray-500 hover:text-gray-700">
            <x-icons.icon-close class="w-6 h-6"/>
        </button>
    </div>

    <div class="p-5">
        {{ $content }}
    </div>

    <div class="flex justify-end items-center gap-3 p-5">
        {{ $footer }}
    </div>
</div>
