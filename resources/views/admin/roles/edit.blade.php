<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div>
                <h1>{{ __('title.role.edit') }}</h1>

                <form action="{{ route('admin.roles.update', ['id' => $role->id ]) }}" method="POST">
                    @csrf

                    <div>
                        <x-label for="name" :value="__('input.label.name')"/>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $role->name }}"
                                 required autofocus/>
                    </div>

                    <div>
                        <div class="flex justify-between align-items flex-wrap">
                            @foreach($permissions as $permission)
                                <div class="w-1/3">
                                    <label class="flex justify-start items-center cursor-pointer relative p-2">
                                        {{ $permission->name }}
                                        <input
                                            type="checkbox"
                                            class="peer hidden"
                                            name="permissions[]" value="{{ $permission->id }}"
                                            @if(in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked
                                            @endif
                                        >
                                        <span
                                            class="bg-gray-300 w-11 h-7 rounded-full flex flex-shrink-0 items-center after:bg-white after:w-5 after:h-5 after:rounded-full p-1 peer-checked:bg-gray-800 peer-checked:after:translate-x-4 ease-in-out duration-300 after:duration-300 ml-2"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('button.action.edit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.admin-app-layout>
