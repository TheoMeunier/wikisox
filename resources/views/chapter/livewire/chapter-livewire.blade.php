<div>
    <div class="flex justify-end mb-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    <div class="articles mt-6">
        @forelse($chapters as $chapter)
            <article class="card @if($chapter->like !== false) card__like @endif">
                <a href="{{ route('book.chapter.page.index', ['slug' => $chapter->book->slug, 'slugChapter' => $chapter->slug]) }}" class="card__img">
                    <img src="{{ $chapter->image }}" alt="{{ $chapter->name }}" width="280" height="100" />
                </a>
                <div class="card__body">
                    <h5 class="card__title">{{ $chapter->name }}</h5>
                    <p class="card__text">{{ str($chapter->description)->limit(60, '...') }}</p>
                    <p class="justify__between" style="margin-bottom: -5px">
                            <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ $chapter->created_at->diffForHumans() }}
                            </span>
                        <a wire:click.prevent="likeChapter({{ $chapter }})" class="cursor-pointer @if($chapter->like !== false) text-yellow-400 @endif text-gray-500">
                            <i class="fa-star mr-2 @if($chapter->like !== false) fa-solid @endif fa-regular"></i>
                        </a>
                    </p>
                </div>
            </article>
        @empty
            <div class="text-center">
                <p class="my-12">{{ __('flash.chapter.empty') }}</p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $chapters->links('components.modules.pagination') }}
    </div>
</div>
