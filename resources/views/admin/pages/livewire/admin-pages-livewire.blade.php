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
        @forelse($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->name }}</td>
                <td>{{ $page->slug }}</td>
                <td>{{ $page->user->name }}</td>
                <td>{{ $page->created_at->format('m/d/Y') }}</td>
                <td>{{ $page->updated_at->format('m/d/Y') }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.pages.edit', ['slug' => $page->slug ]) }}"
                                       class="table-action text-primary">
                        <x-icons.icon-edit class="h-6 w-6"/> {{ __('button.action.edit') }}
                    </a>
                    <button wire:click.prevent="$emit('openModal', 'admin.pages.modals.admin-modal-page-delete-livewire', {{ json_encode(['page' => $page]) }})" class="table-action text-danger">
                        <x-icons.icon-trash class="h-6 w-6"/> {{ __('button.action.delete') }}
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">{{ __('table.empty.pages') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $pages->links('components.modules.pagination') }}
    </div>
</div>


