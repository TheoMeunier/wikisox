<x-app-layout>
    <section class="container">
        <h1>{{ __('title.page.edit') }}</h1>

        <form action="{{ route('pages.update', ['slug' => $page->slug]) }}" method="POST">
            @csrf

            <div>
                <div>
                    <x-label for="name" :value="__('input.label.name')"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $page->name}}"/>
                    @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-10">
                    <x-forms.mde name="content" value="{!! $page->content !!}"></x-forms.mde>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-links.link-button-secondary href="{{ url()->previous() }}">
                    {{ __('button.action.close') }}
                </x-links.link-button-secondary>
                <x-button class="ml-3">
                    {{ __('button.action.edit') }}
                </x-button>
            </div>
        </form>
    </section>
</x-app-layout>
