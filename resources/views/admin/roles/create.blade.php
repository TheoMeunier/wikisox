<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div>
                <h1>{{ __('title.role.create') }}</h1>

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    <div>
                        <x-label for="name" :value="__('input.label.name')"/>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}"/>

                        @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between align-items flex-wrap">
                            @foreach($permissions as $permission)
                                <div class="w-2/6">
                                    <label class="flex justify-start items-center cursor-pointer relative p-2">
                                        {{ $permission->name }}
                                        <input type="checkbox" class="peer hidden" name="permissions[]" value="{{ $permission->id }}">
                                        <span
                                            class="bg-gray-300 w-11 h-7 rounded-full flex flex-shrink-0 items-center after:bg-white after:w-5 after:h-5 after:rounded-full p-1 peer-checked:bg-gray-800 peer-checked:after:translate-x-4 ease-in-out duration-300 after:duration-300 ml-2"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn__secondary">
                            {{ __('button.action.close') }}
                        </a>
                        <x-button class="ml-3">
                            {{ __('button.action.create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.admin-app-layout>
