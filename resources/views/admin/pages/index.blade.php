<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500 text-3xl">
                <x-icons.icon-files class="w-9 h-9"/>
            </span>
            {{ __('title.pages') }}
        </h1>
    </div>

    <div>
        @livewire('admin.pages.admin-pages-livewire')
    </div>
</x-admin.admin-app-layout>
