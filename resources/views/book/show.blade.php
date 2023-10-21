<x-app-layout>
    <section class="container">
        <div>
            <h1>{{ $book->name }}</h1>

            <div class="mt-4">
                {{ Breadcrumbs::render('book', $book) }}
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4">
            <div class="mt-14 flex flex-col">
                @canany(['book edit', 'book delete', 'chapter create'])
                    <div class="flex flex-col gap-5 mt-4 mb-14">
                        <h4>{{ __('title.action') }}</h4>
                        @can('chapter create')
                            <x-links.link-secondary href="{{ route('book.chapter.create', ['slug' => $book->slug]) }}">
                                <x-icons.icon-plus class="h-5 w-5" />
                                {{ __('button.chapter.create') }}
                            </x-links.link-secondary>
                        @endcan
                        @can('book edit')
                            <x-links.link-secondary href="{{ route('book.edit', ['slug' => $book->slug]) }}">
                                <x-icons.icon-edit class="w-5 h-5"/>
                                {{ __('button.book.edit') }}
                            </x-links.link-secondary>
                        @endcan
                        @can('book delete')
                            <form method="post" action="{{ route('book.delete', ['slug' => $book->slug]) }}"
                                  style="display: inline-block"
                                  onsubmit="return confirm('Etes vous vraiment sur ?')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <x-buttons.btn-link-danger>
                                    <x-icons.icon-trash class="w-5 h-5"/>
                                    {{ __('button.book.delete') }}
                                </x-buttons.btn-link-danger>
                            </form>
                        @endcan
                    </div>
                @endcanany

                <div>
                    <h4>{{ __('title.info') }}</h4>
                    <p class="text-gray-500 mt-6 flex items-center gap-2">
                        <x-icons.icon-user class="h-5 w-5"/>
                        {{ __('nav.create_to') }} {{ $book->user->name }}
                    </p>
                    <p class="text-gray-500 mt-6 flex items-center gap-2">
                        <x-icons.icon-clock class="h-5 w-5"/>
                        {{ __('nav.created_at') }} {{ $book->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="col-span-4">
                @livewire('chapter-livewire', ['book' => $book])
            </div>
        </div>
    </section>
</x-app-layout>
