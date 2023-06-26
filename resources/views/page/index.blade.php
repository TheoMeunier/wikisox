<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl py-6 text-gray-800 leading-tight">
            {{ Breadcrumbs::render('chapter', $book, $chapter) }}
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="justify__between">
                <h1>{{ $chapter->name }}</h1>
                @can('page create')
                    <a href="{{ route('book.chapter.page.create', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]) }}"
                       class="btn btn__primary">
                        <i class="fa-solid fa-plus mr-2"></i>
                        {{ __('button.page.create') }}
                    </a>
                @endcan
            </div>

            <div class="grid grid-cols-5 gap-4">
                <div class="mt-14 flex flex-col">
                    @canany(['chapter edit', 'chapter delete'])
                        <div class="flex flex-col mt-4 mb-14">
                            <h4>{{ __('title.action') }}</h4>
                            @can('chapter edit')
                                <a href="{{ route('book.chapter.edit', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]) }}"
                                   class="text-blue-500 my-6">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    {{ __('button.chapter.edit') }}
                                </a>
                            @endcan
                            @can('chapter delete')
                                <form method="post" action="{{ route('chapter.delete', ['slug' => $chapter->slug]) }}"
                                      style="display: inline-block"
                                      onsubmit="return confirm('Etes vous vraiment sur ?')">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="text-red-500">
                                        <i class="fa-solid fa-trash-can mr-2"></i>
                                        {{ __('button.chapter.delete') }}
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endcanany

                    <div>
                        <h4>{{ __('title.info') }}</h4>
                        <p class="text-gray-500 mt-6">
                            <i class="fa-solid fa-user mr-2"></i>
                            {{ __('nav.create_to') }} {{ $chapter->user->name }}
                        </p>
                        <p class="text-gray-500 mt-6">
                            <i class="fa-regular fa-clock mr-2"></i>
                            {{ __('nav.created_at') }} {{ $chapter->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="col-span-4">
                    @if($chapter->pages->count() > 0)
                        <Pages book="{{ $book->slug }}" chapter="{{ $chapter->slug }}"/>
                    @else
                        <div class="text-center">
                            <p class="my-12">{{ __('flash.page.empty') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
