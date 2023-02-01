<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('chapter', $book, $chapter) }}
        </div>
    </x-slot>

    <div class="grid grid-cols-6 py-12">
        <div></div>

        <div class="col-span-4 mx-auto min-w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <Pages title="{{ $chapter->name }}" book="{{ $book->slug }}" chapter="{{ $chapter->slug }}"/>
                </div>
            </div>
        </div>


        <div class="pl-16">
            <div class="mb-3">
                <a href="{{ route('book.chapter.page.create', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]) }}" class="text-blue-500">
                    <i class="fa-solid fa-plus mr-2"></i>
                    {{ __('button.page.create') }}
                </a>
            </div>
            <div class="my-6">
                <a href="{{ route('book.chapter.edit', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]) }}" class="text-blue-500">
                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                    {{ __('button.chapter.edit') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
