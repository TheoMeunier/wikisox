<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl py-6 text-gray-800 leading-tight">
            {{ Breadcrumbs::render('book', $book) }}
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 ">
            <div class="justify__between">
                <h1>{{ $book->name }}</h1>
                @can('chapter create')
                    <a href="{{ route('book.chapter.create', ['slug' => $book->slug]) }}" class="btn btn__primary">
                        <i class="fa-solid fa-plus mr-2"></i>
                        {{ __('button.chapter.create') }}
                    </a>
                @endcan
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div class="mt-14 flex flex-col">
                    @canany(['book edit', 'book delete'])
                        <div class="flex flex-col mt-4 mb-14">
                            <h4>{{ __('title.action') }}</h4>
                            @can('book edit')
                                <a href="{{ route('book.edit', ['slug' => $book->slug]) }}" class="text-blue-500 mt-6">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    {{ __('button.book.edit') }}
                                </a>
                            @endcan
                            @can('book delete')
                                <form method="post" action="{{ route('book.delete', ['slug' => $book->slug]) }}" style="display: inline-block" onsubmit="return confirm('Etes vous vraiment sur ?')">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="text-red-500 mt-6">
                                        <i class="fa-solid fa-trash-can mr-2"></i>
                                        {{ __('button.book.delete') }}
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endcanany

                    <div>
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
                    @if($book->chapters->count() > 0)
                        <Chapters title="{{ $book->name }}" slug="{{ $book->slug }}"/>
                    @else
                        <div class="text-center">
                            <p class="my-12">{{ __('flash.chapter.empty') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
