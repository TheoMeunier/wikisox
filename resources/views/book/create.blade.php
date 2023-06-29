<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl py-6 text-gray-800 leading-tight">
            {{ Breadcrumbs::render('book.create') }}
        </h2>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1>{{ __('title.book.create') }}</h1>

            <form action="{{ route('book.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-3 gap-5">
                    <div class="col-span-2">
                        <div>
                            <x-label for="name" :value="__('input.label.name')"/>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />

                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-10">
                            <x-label for="description" :value="__('input.label.description')"/>
                            <x-forms.textarea name="description" id="description"
                                              value="{{ old('description') }}"></x-forms.textarea>
                            @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <x-label for="image" :value="__('input.label.image')"/>
                        <x-forms.image :name="'image'" value="{{ old('image')}}"/>

                        @error('image')
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
