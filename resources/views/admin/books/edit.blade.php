<x-admin.admin-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.book.edit') }}</h1>

            <form action="{{ route('admin.book.update', ['slug' => $book->slug]) }}" method="POST">
                @csrf

                <div class="flex gap-5">
                    <div class="w-3/4">
                        <div >
                            <x-label for="name" :value="__('input.label.name')"/>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $book->name }}"
                                     required autofocus/>
                        </div>
                        <div class="mt-10">
                            <x-label for="description" :value="__('input.label.description')"/>
                            <x-forms.textarea name="description" id="description" value="{{ $book->description }}"></x-forms.textarea>
                        </div>
                    </div>
                    <div class="w-2/4">
                        <x-label for="image" :value="__('input.label.image')"/>
                        <x-forms.image :name="'image'" value="{{ $book->image }}"/>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('button.action.edit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin.admin-app-layout>



