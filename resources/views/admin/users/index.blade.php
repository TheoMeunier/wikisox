<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500">
                <x-icons.icon-user class="w-9 h-9"/>
            </span>
            {{ __('title.users') }}
        </h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn__primary">
            <i class="fa-solid fa-plus mr-2"></i>
            {{ __('button.action.create') }}
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            @livewire('admin.users.users-livewire')
        </div>
    </div>
</x-admin.admin-app-layout>
