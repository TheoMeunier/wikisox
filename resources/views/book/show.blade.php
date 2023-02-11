<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('book', $book) }}
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 ">
            <div class="justify__between">
                <h1>{{ $book->name }}</h1>
                <a href="{{ route('book.chapter.create', ['slug' => $book->slug]) }}" class="btn btn__primary">
                    <i class="fa-solid fa-plus mr-2"></i>
                    {{ __('button.chapter.create') }}
                </a>
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div class="mt-14 flex flex-col">
                    <div class="flex flex-col">
                        <h4>{{ __('title.action') }}</h4>
                        <a href="{{ route('book.edit', ['slug' => $book->slug]) }}" class="text-blue-500 mt-6">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            {{ __('button.book.edit') }}
                        </a>
                        <a href="{{ route('book.edit', ['slug' => $book->slug]) }}" class="text-red-500 mt-6">
                            <i class="fa-solid fa-trash-can mr-2"></i>
                            {{ __('button.book.delete') }}
                        </a>
                    </div>

                    <div class="mt-14">
                        <h4>{{ __('title.info') }}</h4>
                        <p class="text-gray-500 mt-6">
                            <i class="fa-solid fa-user mr-2"></i>
                            {{ __('nav.create_to') }} {{ $book->user->name }}
                        </p>
                        <p class="text-gray-500 mt-6">
                            <i class="fa-regular fa-clock mr-2"></i>
                            {{ __('nav.created_at') }} {{ $book->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
                <div class="col-span-4">
                    <Chapters title="{{ $book->name }}" slug="{{ $book->slug }}"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
