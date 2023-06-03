<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.user.edit') }}</h1>

            <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
                @csrf

                <div>
                    <x-label for="name" :value="__('input.label.name')"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}"/>

                    @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-label for="email" :value="__('input.label.email')"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}"/>

                    @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-label for="role" :value="__('input.label.roles')"/>
                    <select name="role" class="form-control" id="role">
                        <option value="">{{ __('input.select.role') }}</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>

                    @error('role')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn__secondary">
                        {{ __('button.action.close') }}
                    </a>
                    <x-button class="ml-3">
                        {{ __('button.action.edit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin.admin-app-layout>
