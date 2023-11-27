<div>
    <div class="justify__between my-4">
        @can('book create')
            <x-links.link-button-primary href="{{ route('book.create') }}">
                <x-icons.icon-plus class="w-4 h-4"/>
                {{ __('button.book.create') }}
            </x-links.link-button-primary>
        @endcan
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    <div class="articles__books mt-6">
        @forelse($books as $book)
            <article class="card @if($book->like !== false) card__like @endif">
                <a href="{{ route('book.chapter.index', ['slug' => $book->slug]) }}" class="card__img">
                    <img src="{{ $book->image }}" alt="{{ $book->name }}" width="280" height="100"/>
                </a>
                <div class="card__body">
                    <h5 class="card__title">{{ $book->name }}</h5>
                    <p class="card__text">{{ str($book->description)->limit(60, '...') }}</p>
                    <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text-muted flex items-center gap-2">
                                <x-icons.icon-clock class="w-5 h-5"/>
                                {{ $book->created_at->diffForHumans() }}
                            </span>
                        <a wire:click.prevent="likeBook({{ $book }})"
                           class="cursor-pointer @if($book->like !== false) text-yellow-400 @endif text-gray-500">
                            @if($book->like !== true)
                                <x-icons.icon-start class="w-6 h-6"/>
                            @else
                                <x-icons.icon-start-solid class="w-6 h-6"/>
                            @endif
                        </a>
                    </p>
                </div>
            </article>
        @empty
    </div>
    <p class="my-12 text-center">{{ __('table.empty.books') }}</p>
    @endforelse


    <div class="pagination">
        {{ $books->links('components.modules.pagination') }}
    </div>
</div>
