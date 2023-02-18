<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Mon profile
        </div>
    </x-slot>

    <section class="card card__body grid grid-cols-2 mb-8">
        <div class="w-2/4">
            <h2 class="h3">{{ auth()->user()->name }}</h2>
            <p class="text-gray-500 mt-2">{{ __('page/profile.created_at') }} {{ auth()->user()->created_at->diffForHumans(null, true) }}</p>
        </div>

        <div>
            <h2 class="h5 text-gray-500">{{ __('page/profile.create_content') }}</h2>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <p class="text-red-500">
                        <i class="fa-solid fa-book-bookmark mr-2"></i>
                        {{ __('page/profile.books') }} {{ $counts->books_count }}
                    </p>
                    <p class="text-cyan-500">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        {{ __('page/profile.chapters') }} {{ $counts->chapters_count }}
                    </p>
                </div>
                <div>
                    <p class="text-emerald-500"><i class="fa-sharp fa-solid fa-file-circle-check mr-2"></i>
                        {{ __('page/profile.pages') }} {{ $counts->pages_count }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="card card__body mb-8">
        <h2>{{ __('title.profile.books') }}</h2>

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
                        <span class="text__secondary">
                            <i class="fa-regular fa-clock mr-2"></i>
                            {{ $book->created_at->diffForHumans() }}
                        </span>
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="text-center my-4">{{ auth()->user()->name }} {{ __('page/profile.dont_create', ['param' => 'livres']) }}</p>
        @endif
    </section>

    <section class="card card__body mb-8">
        <h2>{{ __('title.profile.chapters') }}</h2>

        @if($chapters->count() > 0)
            <div class="grid grid-cols-4 gap-5 mt-3">
                @foreach($chapters as $chapter)
                    <article class="card">
                        <div class="card__img">
                            <img src="{{ $chapter->image }}" alt="{{ $chapter->name }}" width="280" height="100"/>
                        </div>
                        <div class="card__body">
                            <h5 class="card__title">{{ $chapter->name }}</h5>
                            <p class="card__text">{{ $chapter->description }}</p>
                            <p class="justify__between" style="margin-bottom: -5px">
                        <span class="text__secondary">
                            <i class="fa-regular fa-clock mr-2"></i>
                            {{ $chapter->created_at->diffForHumans() }}
                        </span>
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="text-center my-4">{{ auth()->user()->name }} {{ __('page/profile.dont_create', ['param' => 'chapitres']) }}</p>
        @endif
    </section>

    <section class="card card__body mb-8">
        <h2>{{ __('title.profile.pages') }}</h2>

        @if($pages->count() > 0)
            <div class="grid grid-cols-4 gap-5 mt-3">
                @foreach($pages as $page)
                    <div>
                        <article class="card">
                            <div class="card__body justify__between">
                                <h5 class="card__title border-left">{{ $page->name }}</h5>
                                <span class="text__secondary">
                                <i class="fa-regular fa-clock mr-2"></i>
                                {{ $page->created_at->diffForHumans() }}
                            </span>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center my-4">{{ auth()->user()->name }} {{ __('page/profile.dont_create', ['param' => 'pages']) }}</p>
        @endif
    </section>
</x-app-layout>
