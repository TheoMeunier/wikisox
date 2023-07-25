<div>
    <div class="flex justify-end mb-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    <table>
        <thead>
        <tr>
            <th>{{ __('table.id') }}</th>
            <th>{{ __('table.image') }}</th>
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
                <td>
                    <img src="{{ $chapter->image }}" alt="{{ $chapter->slug }}" width="30" height="50">
                </td>
                <td>{{ $chapter->name }}</td>
                <td>{{ $chapter->slug }}</td>
                <td>{{ $chapter->user->name }}</td>
                <td>{{ $chapter->created_at->format('m/d/Y') }}</td>
                <td>{{ $chapter->updated_at->format('m/d/Y') }}</td>
                <td>
                    <x-links.link-icon href="{{ route('admin.chapters.edit', ['slug' => $chapter->slug ]) }}"
                                       class="text-indigo-500">
                        <x-icons.icon-edit class="h-6 w-6"/>
                    </x-links.link-icon>
                    <x-buttons.btn-icon wire:click.prevent="$emit('openModal', 'admin.chapters.modals.admin-modal-chapter-delete-livewire', {{ json_encode(['chapter' => $chapter]) }})" class="text-red-500">
                        <x-icons.icon-trash class="h-6 w-6"/>
                    </x-buttons.btn-icon>
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


