<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500 text-3xl">
                <x-icons.icon-roles class="w-9 h-9"/>
            </span>
            {{ __('title.roles') }}
        </h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn__primary">
            <i class="fa-solid fa-plus mr-2"></i>
            {{ __('button.action.create') }}
        </a>
    </div>

    <div>
        @livewire('admin.roles.admin-roles-livewire')
    </div>
</x-admin.admin-app-layout>
