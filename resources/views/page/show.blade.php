<x-app-layout>
    <section>
        <div class="grid grid-cols-5 gap-4">
            <div class="flex flex-col">
                <div class="flex flex-col gap-5 mt-4 mb-14">
                    <h4>{{ __('title.action') }}</h4>
                    @livewire('pages.page-share-livewire', ['page' => $page])
                    @canany(['page edit', 'page delete'])
                        @can('page edit')
                            <x-links.link-secondary
                                href="{{ route('book.chapter.page.edit', ['slug' => $book->slug, 'slugChapter' => $chapter->slug, 'slugPage' => $page->slug, 'id' => $page->id]) }}"
                                class="text-blue-500 my-6">
                                <x-icons.icon-edit class="w-5 h-5"/>
                                {{ __('button.page.edit') }}
                            </x-links.link-secondary>
                        @endcan
                        @can('page delete')
                            <form method="POST" action="{{ route('pages.delete', ['slug' => $page->slug, 'id' => $page->id]) }}"
                                  style="display: inline-block"
                                  onsubmit="return confirm('Etes vous vraiment sur ?')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <x-buttons.btn-link-danger>
                                    <x-icons.icon-trash class="w-5 h-5"/>
                                    {{ __('button.page.delete') }}
                                </x-buttons.btn-link-danger>
                            </form>
                        @endcan
                </div>
                @endcanany

                <div class="flex flex-col gap-5 mt-4 mb-14">
                    <h4>{{ __('title.download') }}</h4>
                    <x-links.link-mounted href="{{ route('pages.download.html', ['slug' => $page->slug, 'id' => $page->id]) }}"
                                          class="text-gray-500 mt-6">
                        <x-icons.icon-file-html/>
                        {{ __('button.page.download.html') }}
                    </x-links.link-mounted>
                    <x-links.link-mounted href="{{ route('pages.download.md', ['slug' => $page->slug, 'id' => $page->id]) }}"
                                          class="text-gray-500 mt-6">
                        <x-icons.icon-file-edit/>
                        {{ __('button.page.download.md') }}
                    </x-links.link-mounted>
                    <x-links.link-mounted href="{{ route('pages.download.pdf', ['slug' => $page->slug, 'id' => $page->id]) }}"
                                          class="text-gray-500 mt-6">
                        <x-icons.icon-file-image/>
                        {{ __('button.page.download.pdf') }}
                    </x-links.link-mounted>
                </div>

                <div>
                    <h4>{{ __('title.info') }}</h4>
                    <p class="text-gray-500 mt-6 flex items-center gap-2">
                        <x-icons.icon-user class="h-5 w-5"/>
                        {{ __('nav.create_to') }} {{ $page->user->name }}
                    </p>
                    <p class="text-gray-500 mt-6 flex items-center gap-2">
                        <x-icons.icon-clock class="h-5 w-5"/>
                        {{ __('nav.created_at') }} {{ $page->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="col-span-4">
                <div class="pb-16">
                    <h1>{{ $page->name }}</h1>

                    <div class="mt-4">
                        {{ Breadcrumbs::render('page', $book, $chapter, $page) }}
                    </div>
                </div>

                <div class="formatted" style="max-width: 100%">
                    {!! $page->parse_content !!}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
