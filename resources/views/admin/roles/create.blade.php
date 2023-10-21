<x-admin.admin-app-layout>
    <div>
        <div>
            <h1>
                 <span class="text-indigo-500 mr-3">
                    <x-icons.icon-roles class="w-8 h-8"/>
                </span>
                {{ __('title.role.create') }}
            </h1>

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
                                <x-forms.toggle :label="$permission->name" name="permissions[]" :value="$permission->id"/>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-links.link-button-secondary href="{{ url()->previous() }}">
                        {{ __('button.action.close') }}
                    </x-links.link-button-secondary>
                    <x-button class="ml-3">
                        {{ __('button.action.create') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin.admin-app-layout>
