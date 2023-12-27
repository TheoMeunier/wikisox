<x-app-layout>
    <section>
        <div class="justify__between">
            <h1>{{ __('title.books') }}</h1>
            @can('book create')
                <x-links.link-button-primary href="{{ route('book.create') }}">
                    <x-icons.icon-plus class="w-4 h-4"/>
                    {{ __('button.book.create') }}
                </x-links.link-button-primary>
            @endcan
        </div>

        @livewire('book-livewire')
    </section>
</x-app-layout>
