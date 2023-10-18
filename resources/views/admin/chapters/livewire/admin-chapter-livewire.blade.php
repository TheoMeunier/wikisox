<div>
    <div class="flex justify-end mb-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    <table>
        <thead>
        <tr>
            <th>{{ __('table.id') }}</th>
            <th>{{ __('table.name') }}</th>
            <th>{{ __('table.slug') }}</th>
            <th>{{ __('table.createdTo') }}</th>
            <th>{{ __('table.createdAt') }}</th>
            <th>{{ __('table.updatedAt') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($chapters as $chapter)
            <tr>
                <td>{{ $chapter->id }}</td>
                <td>{{ $chapter->name }}</td>
                <td>{{ $chapter->slug }}</td>
                <td>{{ $chapter->user->name }}</td>
                <td>{{ $chapter->created_at->format('m/d/Y') }}</td>
                <td>{{ $chapter->updated_at->format('m/d/Y') }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.chapters.edit', ['slug' => $chapter->slug ]) }}"
                                       class="table-action text-primary">
                        <x-icons.icon-edit class="h-6 w-6"/> {{ __('button.action.edit') }}
                    </a>
                    <button wire:click.prevent="$emit('openModal', 'admin.chapters.modals.admin-modal-chapter-delete-livewire', {{ json_encode(['chapter' => $chapter]) }})" class="table-action text-danger">
                        <x-icons.icon-trash class="h-6 w-6"/> {{ __('button.action.delete') }}
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">{{ __('table.empty.chapters') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $chapters->links('components.modules.pagination') }}
    </div>
</div>


