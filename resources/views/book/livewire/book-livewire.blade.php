<div>
    <div class="flex justify-end my-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    @if(count($books) > 0)
        <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 mt-6">
            @foreach($books as $book)
                <article class="card @if($book->like !== false) card__like @endif">
                    <a href="{{ route('book.chapter.index', ['slug' => $book->slug]) }}" class="card__img">
                        <img src="{{ $book->getImageUrl(332, 225) }}" alt="{{ $book->name }}" width="332" height="225"/>
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
            @endforeach
        </div>
    @else
        <p class="my-12 text-center">{{ __('table.empty.books') }}</p>
    @endif


    <div class="pagination">
        {{ $books->links('components.modules.pagination') }}
    </div>
</div>
