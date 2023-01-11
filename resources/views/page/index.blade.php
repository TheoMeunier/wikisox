<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('chapter', $book, $chapter) }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <Pages title="{{ $chapter->name }}" book="{{ $book->slug }}" chapter="{{ $chapter->slug }}"/>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card mt-3 mr-2">
            <div class="card__body">
                <h5 class="ms-3">{{ __('title.action') }}</h5>
                <div class="mt-3">
                    <div class="mb-3">
                        <a href="{{ route('book.chapter.page.create', ['slug' => $book, 'slugChapter' => $chapter->slug]) }}">
                            <i class="fa-solid fa-plus mr-2"></i>
                            {{ __('button.chapter.create') }}
                        </a>
                    </div>
                    <hr/>
                    <div class="my-3">
                        <a href="{{ route('book.chapter.edit', ['slug' => $book, 'slugChapter' => $chapter->slug]) }}">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            {{ __('button.book.edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
