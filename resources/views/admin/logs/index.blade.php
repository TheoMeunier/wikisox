<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500">
                <x-icons.icon-logs class="w-8 h-8"/>
            </span>
            {{ __('title.logs') }}
        </h1>
    </div>

    <div>
        @livewire('admin-logs-livewire')
    </div>
</x-admin.admin-app-layout>



