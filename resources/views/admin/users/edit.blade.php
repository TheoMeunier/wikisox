<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.user.edit') }}</h1>

            <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
                @csrf

                <div>
                    <x-label for="name" :value="__('input.label.name')"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}"
                             required autofocus/>
                </div>

                <div>
                    <x-label for="email" :value="__('input.label.email')"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}"
                             required autofocus/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('button.action.edit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin.admin-app-layout>
