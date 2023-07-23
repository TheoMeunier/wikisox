<div>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500">
                <x-icons.icon-user class="w-9 h-9"/>
            </span>
            {{ __('title.users') }}
        </h1>
        <x-buttons.primary-button wire:click.prevent="$emit('openModal', 'admin.users.modals.admin-modal-user-create-livewire')" class="btn btn__primary">
            <i class="fa-solid fa-plus mr-2"></i>
            {{ __('button.action.create') }}
        </x-buttons.primary-button>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-end mb-4">
                <x-input wire:model="search" type="search"
                         :placeholder="__('input.placeholder.search')"/>
            </div>

            <table>
                <thead>
                <tr>
                    <th>{{ __('table.id') }}</th>
                    <th>{{ __('table.name') }}</th>
                    <th>{{ __('table.email') }}</th>
                    <th>{{ __('table.roles') }}</th>
                    <th>{{ __('table.verify') }}</th>
                    <th>{{ __('table.createdAt') }}</th>
                    <th>{{ __('table.updatedAt') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->first()->name ?? '' }}</td>
                        <td>
                            @if($user->email_verified_at)
                                <span class="tag tag-success">
                            {{ __('tag.verify') }}
                        </span>
                            @else
                                <span class="tag tag-danger">
                            {{ __('tag.notVerify') }}
                        </span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('m/d/Y') }}</td>
                        <td>{{ $user->updated_at->format('m/d/Y') }}</td>
                        <td>
                            <x-links.link-icon href="{{ route('admin.users.edit', ['id' => $user->id ]) }}"
                                               class="text-indigo-500">
                                <x-icons.icon-edit class="h-6 w-6"/>
                            </x-links.link-icon>
                            @if($user->roles->first() && $user->roles->first()->name !== 'admin')
                                <x-buttons.btn-icon class="text-red-500">
                                    <x-icons.icon-trash class="h-6 w-6"/>
                                </x-buttons.btn-icon>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">{{ __('table.empty.users') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $users->links('components.modules.pagination') }}
            </div>
        </div>
    </div>
</div>
