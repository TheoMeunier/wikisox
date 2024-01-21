<x-app-layout>
    <section class="container">
        <h1>{{ __('title.book.edit') }}</h1>

        <form action="{{ route('chapter.update', ['slug' => $chapter->slug ]) }}" method="POST">
            @csrf

            <div>
                <div>
                    <x-label for="name" :value="__('input.label.name')"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                             value="{{ $chapter->name }}"/>
                    @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-1/4 mt-4">
                    <x-label for="image" :value="__('input.label.image')"/>
                    <x-forms.image :name="'image'" value="{{ $chapter->getImageUrl(326, 192) }}"/>
                    @error('image')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="description" :value="__('input.label.description')"/>
                    <x-forms.textarea name="description" id="description"
                                      value="{{ $chapter->description }}"></x-forms.textarea>
                    @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
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
