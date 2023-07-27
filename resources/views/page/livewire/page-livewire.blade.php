<div>
    <div class="flex justify-end mb-4">
        <x-input wire:model="search" type="search"
                 :placeholder="__('input.placeholder.search')"/>
    </div>

    <div class="mt-6">
        @forelse($pages as $page)
            <a href="{{ route('book.chapter.page.show', ['slug' => $page->chapter->book->slug, 'slugChapter' => $page->chapter->slug, 'slugPage' => $page->slug]) }}">
                <article class="card">
                    <div class="card__body justify__between">
                        <h5 class="card__title border-left">{{ $page->name }}</h5>
                        <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ $page->created_at->diffForHumans() }}
                            </span>
                    </div>
                </article>
            </a>
        @empty
            <div class="text-center">
                <p class="my-12">{{ __('flash.page.empty') }}</p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $pages->links('components.modules.pagination') }}
    </div>
</div>