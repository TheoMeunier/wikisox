<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('book', $book) }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="justify__between">
                        <h1>{{ $book->name }}</h1>
                        <a href="{{ route('book.chapter.create', ['slug' => $book->slug]) }}" class="btn btn__primary">
                            <i class="fa-solid fa-plus mr-2"></i>
                            {{ __('button.chapter.create') }}
                        </a>
                    </div>
                    <Chapters title="{{ $book->name }}" slug="{{ $book->slug }}"/>
                </div>
            </div>
        </div>
    </div>

    <div class="pl-16">
        <div class="my-6">
            <a href="{{ route('book.edit', ['slug' => $book->slug]) }}" class="text-blue-500">
                <i class="fa-solid fa-pen-to-square mr-2"></i>
                {{ __('button.book.edit') }}
            </a>
        </div>
    </div>
</x-app-layout>
