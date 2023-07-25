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
                <td>
                    <x-links.link-icon href="{{ route('admin.pages.edit', ['slug' => $page->slug ]) }}"
                                       class="text-indigo-500">
                        <x-icons.icon-edit class="h-6 w-6"/>
                    </x-links.link-icon>
                    <x-buttons.btn-icon wire:click.prevent="$emit('openModal', 'admin.pages.modals.admin-modal-page-delete-livewire', {{ json_encode(['page' => $page]) }})" class="text-red-500">
                        <x-icons.icon-trash class="h-6 w-6"/>
                    </x-buttons.btn-icon>
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


