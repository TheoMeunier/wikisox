<x-admin.admin-app-layout>
    <div>
        <h1>
             <span class="text-indigo-500 mr-3">
                <x-icons.icon-folders class="w-8 h-8"/>
            </span>
            {{ __('title.chapter.edit') }}
        </h1>

        <form action="{{ route('admin.chapters.update', ['slug' => $chapter->slug]) }}" method="POST">
            @csrf

            <div class="flex gap-5">
                <div class="w-3/4">
                    <div>
                        <x-label for="name" :value="__('input.label.name')"/>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                 value="{{ $chapter->name }}"/>
                        @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-10">
                        <x-label for="description" :value="__('input.label.description')"/>
                        <x-forms.textarea name="description" id="description"
                                          value="{{ $chapter->description }}"></x-forms.textarea>
                        @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="w-2/4">
                    <x-label for="image" :value="__('input.label.image')"/>
                    <x-forms.image :name="'image'" value="{{ $chapter->image }}"/>
                    @error('image')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-links.link-button-primary href="{{ url()->previous() }}">
                    {{ __('button.action.close') }}
                </x-links.link-button-primary>
                <x-button class="ml-3">
                    {{ __('button.action.edit') }}
                </x-button>
            </div>
        </form>
    </div>
</x-admin.admin-app-layout>



