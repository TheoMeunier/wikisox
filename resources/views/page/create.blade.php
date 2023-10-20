<x-app-layout>
    <section class="container">
        <h1>{{ __('title.page.create') }}</h1>

        <form
            action="{{ route('book.chapter.page.create', ['slug' => $chapter->book->slug, 'slugChapter' => $chapter->slug]) }}"
            method="POST">
            @csrf

            <div>
                <div>
                    <x-label for="name" :value="__('input.label.name')"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"/>
                    @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6">
                    <x-label for="name" :value="__('input.label.content')"/>
                    <x-forms.mde name="content" value="{{ old('content') }}"></x-forms.mde>
                    @error('content')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-links.link-button-secondary href="{{ url()->previous() }}">
                    {{ __('button.action.close') }}
                </x-links.link-button-secondary>
                <x-button class="ml-3">
                    {{ __('button.action.create') }}
                </x-button>
            </div>
        </form>
    </section>
</x-app-layout>
