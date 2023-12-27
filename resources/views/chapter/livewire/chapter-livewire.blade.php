<div>
    <div class="flex justify-end mb-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    @if(count($chapters) > 0)
        <div class="articles mt-6">
            @foreach($chapters as $chapter)
                <article class="card @if($chapter->like !== false) card__like @endif">
                    <a href="{{ route('book.chapter.page.index', ['slug' => $chapter->book->slug, 'slugChapter' => $chapter->slug]) }}"
                       class="card__img">
                        <img src="{{ $chapter->image }}" alt="{{ $chapter->name }}" width="280" height="100"/>
                    </a>
                    <div class="card__body">
                        <h5 class="card__title">{{ $chapter->name }}</h5>
                        <p class="card__text">{{ str($chapter->description)->limit(60, '...') }}</p>
                        <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text__secondary flex items-center gap-2">
                                <x-icons.icon-clock class="w-5 h-5"/>
                                {{ $chapter->created_at->diffForHumans() }}
                            </span>
                            <a wire:click.prevent="likeChapter({{ $chapter }})"
                               class="cursor-pointer @if($chapter->like !== false) text-yellow-400 @endif text-gray-500">
                                @if($chapter->like !== true)
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
        <p class="my-12 text-center">{{ __('table.empty.chapters') }}</p>
    @endif

    <div class="pagination">
        {{ $chapters->links('components.modules.pagination') }}
    </div>
</div>
