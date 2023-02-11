<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('home') }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="width: 100%">
                    <div class="justify__between ">
                        <h1>{{ __('title.books') }}</h1>
                        <a href="{{ route('book.create') }}" class="btn btn__primary">
                            <i class="fa-solid fa-plus mr-2"></i>
                            {{ __('button.book.create') }}
                        </a>
                    </div>

                    <Books/>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
