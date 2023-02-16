<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.user.edit') }}</h1>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div>
                    <x-label for="name" :value="__('input.label.name')"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}"
                             required autofocus/>
                </div>

                <div>
                    <x-label for="email" :value="__('input.label.email')"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}"
                             required autofocus/>
                </div>

                <div>
                    <x-label for="role" :value="__('input.label.roles')"/>
                    <select name="role" class="form-control" id="role">
                        <option value="">--Please choose an option--</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label for="password" :value="__('input.label.password')"/>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                             value="{{ old('password') }}"
                             required autofocus/>
                </div>

                <div>
                    <x-label for="password" :value="__('input.label.confirm-password')"/>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password_confirmation"
                             value="{{ old('password') }}"
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
