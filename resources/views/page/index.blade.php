<x-app-layout>
    <section class="container">
        <div>
            <h1>{{ $chapter->name }}</h1>

            <div class="mt-4">
                {{ Breadcrumbs::render('chapter', $book, $chapter) }}
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4">
            <div class="mt-14 flex flex-col">
                @canany(['chapter edit', 'chapter delete', 'page create'])
                    <div class="flex flex-col gap-5 mt-4 mb-14">
                        <h4>{{ __('title.action') }}</h4>
                        @can('page create')
                            <x-links.link-secondary href="{{ route('book.chapter.page.create', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]) }}"
                               class="btn btn__primary">
                                <x-icons.icon-plus class="h-5 w-5" />
                                {{ __('button.page.create') }}
                            </x-links.link-secondary>
                        @endcan
                        @can('chapter edit')
                            <x-links.link-secondary href="{{ route('book.chapter.edit', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]) }}"
                               class="text-blue-500 my-6">
                                <x-icons.icon-edit class="w-5 h-5"/>
                                {{ __('button.chapter.edit') }}
                            </x-links.link-secondary>
                        @endcan
                        @can('chapter delete')
                            <form method="post" action="{{ route('chapter.delete', ['slug' => $chapter->slug]) }}"
                                  style="display: inline-block"
                                  onsubmit="return confirm('Etes vous vraiment sur ?')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <x-buttons.btn-link-danger>
                                    <x-icons.icon-trash class="w-5 h-5"/>
                                    {{ __('button.chapter.delete') }}
                                </x-buttons.btn-link-danger>
                            </form>
                        @endcan
                    </div>
                @endcanany

                <div>
                    <h4>{{ __('title.info') }}</h4>
                    <p class="text-gray-500 mt-6 flex items-center gap-2">
                        <x-icons.icon-user class="h-5 w-5"/>
                        {{ __('nav.create_to') }} {{ $chapter->user->name }}
                    </p>
                    <p class="text-gray-500 mt-6 flex items-center gap-2">
                        <x-icons.icon-clock class="h-5 w-5"/>
                        {{ __('nav.created_at') }} {{ $chapter->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="col-span-4">
                @livewire('page-livewire', ['chapter' => $chapter])
            </div>
        </div>
    </section>
</x-app-layout>
