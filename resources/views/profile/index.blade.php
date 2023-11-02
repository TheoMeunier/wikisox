<x-layouts.profile.layouts>
    <div class="mb-16">
        <h2 class="h3">{{ __('title.profile.books') }}</h2>

        @if($books->count() > 0)
            <div class="grid grid-cols-4 gap-5 mt-3">
                @foreach($books as $book)
                    <article class="card">
                        <div class="card__img">
                            <img src="{{ $book->image }}" alt="{{ $book->name }}" width="280" height="100"/>
                        </div>
                        <div class="card__body">
                            <h5 class="card__title">{{ $book->name }}</h5>
                            <p class="card__text">{{ $book->description }}</p>
                            <p class="justify__between" style="margin-bottom: -5px">
                        <span class="text__secondary flex items-center gap-2">
                            <x-icons.icon-clock class="h-5 w-5"/>
                            {{ $book->created_at->diffForHumans() }}
                        </span>
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="my-4">{{ auth()->user()->name }} {{ __('page/profile.dont_create', ['param' => 'livres']) }}</p>
        @endif
    </div>

    <div class="grid grid-cols-2 gap-5">
        <div>
            <h2 class="h3">{{ __('title.profile.chapters') }}</h2>

            @if($chapters->count() > 0)
                @foreach($chapters as $chapter)
                    <article class="card">
                        <div class="card__body grid grid-cols-2">
                            <div>
                                <h5 class="card__title">{{ $chapter->name }}</h5>
                                <p class="card__text">{{ $chapter->description }}</p>
                            </div>
                            <div class="flex justify-center">
                                <img src="{{ $chapter->image }}" alt="{{ $chapter->image }}" width="100" height="100">
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <p class="my-4">{{ auth()->user()->name }} {{ __('page/profile.dont_create', ['param' => 'chapitres']) }}</p>
            @endif
        </div>

        <div>
            <h2 class="h3">{{ __('title.profile.pages') }}</h2>

            @if($pages->count() > 0)
                @foreach($pages as $page)
                    <article class="card">
                        <div class="card__body justify__between">
                            <h5 class="card__title border-left">{{ $page->name }}</h5>
                            <span class="text__secondary flex items-center gap-2">
                                    <x-icons.icon-clock class="h-5 w-5"/>
                                    {{ $page->created_at->diffForHumans() }}
                                </span>
                        </div>
                    </article>
                @endforeach
            @else
                <p class="my-4">{{ auth()->user()->name }} {{ __('page/profile.dont_create', ['param' => 'pages']) }}</p>
            @endif
        </div>
    </div>
</x-layouts.profile.layouts>
