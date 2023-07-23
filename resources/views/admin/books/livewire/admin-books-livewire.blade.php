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
        @forelse($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>
                    <img src="{{ $book->image }}" alt="{{ $book->slug }}" width="30" height="50">
                </td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->slug }}</td>
                <td>{{ $book->user->name }}</td>
                <td>{{ $book->created_at->format('m/d/Y') }}</td>
                <td>{{ $book->updated_at->format('m/d/Y') }}</td>
                <td>
                    <x-links.link-icon href="{{ route('admin.book.edit', ['slug' => $book->slug ]) }}"
                                       class="text-indigo-500">
                        <x-icons.icon-edit class="h-6 w-6"/>
                    </x-links.link-icon>
                    <x-buttons.btn-icon class="text-red-500">
                        <x-icons.icon-trash class="h-6 w-6"/>
                    </x-buttons.btn-icon>
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
        {{ $books->links('components.modules.pagination') }}
    </div>
</div>

