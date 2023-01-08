<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 prose prose-img:rounded-xl prose-a:text-blue-600 max-w-none">
                    <x-markdown :anchors="false">
                        {!! $page->content !!}
                    </x-markdown>
    
                   {{-- {!! Illuminate\Support\Str::markdown($page->content) !!}--}}
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <div class="card mt-3 mr-2">
            <div class="card__body">
                <h5 class="ms-3">{{ __('title.action') }}</h5>
                <div class="mt-3">
                    <div class="my-3">
                        <a href="{{ route('book.chapter.page.edit', ['slug' => $book, 'slugChapter' => $chapter, 'slugPage' => $page->slug]) }}">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            {{ __('button.book.edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
