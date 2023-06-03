<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('page.create', $book, $chapter) }}
        </h2>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.page.create') }}</h1>

            <form
                action="{{ route('book.chapter.page.create', ['slug' => $chapter->book->slug, 'slugChapter' => $chapter->slug]) }}"
                method="POST"
                id="form_page">
                @csrf

                <div>
                    <div>
                        <x-label for="name" :value="__('input.label.name')"/>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"/>
                        @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-label for="description" :value="__('input.label.description')"/>
                        <x-forms.editor name="content" :value="old('content')"/>
                        @error('content')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn__secondary">
                        {{ __('button.action.close') }}
                    </a>
                    <x-button class="ml-3">
                        {{ __('button.action.create') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
