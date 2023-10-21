<x-admin.admin-app-layout>
    <div>
        <h1>
             <span class="text-indigo-500 mr-3">
                <x-icons.icon-roles class="w-9 h-9"/>
             </span>
            {{ __('title.role.edit') }}
        </h1>

        <form action="{{ route('admin.roles.update', ['id' => $role->id ]) }}" method="POST">
            @csrf

            <div>
                <x-label for="name" :value="__('input.label.name')"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $role->name }}"/>
                @error('name')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <div class="flex justify-between align-items flex-wrap">
                    @foreach($permissions as $permission)
                        <div class="w-1/3">
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
                    {{ __('button.action.edit') }}
                </x-button>
            </div>
        </form>
    </div>
</x-admin.admin-app-layout>
