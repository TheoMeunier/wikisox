<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="justify__between">
                <h1>{{ __('title.users') }}</h1>
                <a href="{{ route('admin.users.create') }}" class="btn btn__primary">
                    <i class="fa-solid fa-plus mr-2"></i>
                    {{ __('button.action.create') }}
                </a>
            </div>
            <Admin-Users/>
        </div>
    </div>
</x-admin.admin-app-layout>
