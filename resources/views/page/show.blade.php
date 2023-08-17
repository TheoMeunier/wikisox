<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl py-6 text-gray-800 leading-tight">
            {{ Breadcrumbs::render('page', $book, $chapter, $page) }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-5 gap-4">
                <div class="flex flex-col">
                    @canany(['page edit', 'page delete'])
                        <div class="flex flex-col mt-4 mb-14">
                            <h4>{{ __('title.action') }}</h4>
                            @can('page edit')
                                <a href="{{ route('book.chapter.page.edit', ['slug' => $book->slug, 'slugChapter' => $chapter->slug, 'slugPage' => $page->slug]) }}"
                                   class="text-blue-500 my-6">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    {{ __('button.page.edit') }}
                                </a>
                            @endcan
                            @can('page delete')
                                <form method="POST" action="{{ route('pages.delete', ['slug' => $page->slug]) }}"
                                      style="display: inline-block"
                                      onsubmit="return confirm('Etes vous vraiment sur ?')">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="text-red-500">
                                        <i class="fa-solid fa-trash-can mr-2"></i>
                                        {{ __('button.page.delete') }}
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endcanany

                    <div class="flex flex-col mt-4 mb-14">
                        <h4>{{ __('title.download') }}</h4>
                        <a href="{{ route('pages.download.html', ['slug' => $page->slug]) }}" class="text-gray-500 mt-6">
                            <i class="fa-solid fa-file-code mr-2"></i>
                            {{ __('button.page.download.html') }}
                        </a>
                        <a href="{{ route('pages.download.md', ['slug' => $page->slug ]) }}" class="text-gray-500 mt-6">
                            <i class="fa-brands fa-markdown mr-2"></i>
                            {{ __('button.page.download.md') }}
                        </a>
                        <a href="{{ route('pages.download.pdf', ['slug' => $page->slug ]) }}" class="text-gray-500 mt-6">
                            <i class="fa-solid fa-file-pdf mr-2"></i>
                            {{ __('button.page.download.pdf') }}
                        </a>
                    </div>

                    <div>
                        <h4>{{ __('title.info') }}</h4>
                        <p class="text-gray-500 mt-6">
                            <i class="fa-solid fa-user mr-2"></i>
                            {{ __('nav.create_to') }} {{ $page->user->name }}
                        </p>
                        <p class="text-gray-500 mt-6">
                            <i class="fa-regular fa-clock mr-2"></i>
                            {{ __('nav.created_at') }} {{ $page->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="col-span-4">
                    <div class="pb-9">
                        <h1>{{ $page->name }}</h1>
                    </div>

                    <x-markdown class="formatted" style="max-width: 100%">
                        {!! $page->content !!}
                    </x-markdown>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
