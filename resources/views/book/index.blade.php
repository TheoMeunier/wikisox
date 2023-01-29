<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('home') }}
        </div>
    </x-slot>

    <div class="grid grid-cols-6 py-12">
        <div></div>

        <div class="col-span-4 mx-auto min-w-10/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="width: 100%">
                    <Books title="{{ __('title.books') }}"/>
                </div>
            </div>
        </div>

        <div class="pl-16">
            <a href="{{ route('book.create') }}" class="text-blue-500">
                <i class="fa-solid fa-plus mr-2"></i>
                {{ __('button.book.create') }}
            </a>
        </div>
    </div>

</x-app-layout>
