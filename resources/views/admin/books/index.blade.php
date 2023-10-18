<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500 text-3xl">
                <x-icons.icon-books class="w-8 h-8"/>
            </span>
            {{ __('title.books') }}
        </h1>
    </div>

    <div>
        @livewire('admin.books.admin-books-livewire')
    </div>
</x-admin.admin-app-layout>



