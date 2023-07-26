<div>
    <div class="flex justify-end mb-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    <div class="articles__books mt-6">
        @forelse($books as $book)
            <article class="card @if($book->like !== false) card__like @endif">
                <a href="{{ route('book.chapter.index', ['slug' => $book->slug]) }}" class="card__img">
                    <img src="{{ $book->image }}" alt="{{ $book->name }}" width="280" height="100" />
                </a>
                <div class="card__body">
                    <h5 class="card__title">{{ $book->name }}</h5>
                    <p class="card__text">{{ str($book->description)->limit(60, '...') }}</p>
                    <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ $book->created_at->diffForHumans() }}
                            </span>
                        <a wire:click.prevent="likeBook({{ $book }})" class="cursor-pointer @if($book->like !== false) text-yellow-400 @endif text-gray-500">
                            <i class="fa-star mr-2 @if($book->like !== false) fa-solid @endif fa-regular"></i>
                        </a>
                    </p>
                </div>
            </article>
        @empty
            <div class="text-center">
                <p class="my-12">{{ __('flash.book.empty') }}</p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $books->links('components.modules.pagination') }}
    </div>
</div>
