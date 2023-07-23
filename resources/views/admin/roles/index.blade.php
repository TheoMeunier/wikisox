<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500 text-3xl">
                <i class="fa-solid fa-user-gear"></i>
            </span>
            {{ __('title.roles') }}
        </h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn__primary">
            <i class="fa-solid fa-plus mr-2"></i>
            {{ __('button.action.create') }}
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 mx-5">
            <div class="mt-8">
               @livewire('admin.roles.admin-roles-livewire')
            </div>
        </div>
    </div>
</x-admin.admin-app-layout>
