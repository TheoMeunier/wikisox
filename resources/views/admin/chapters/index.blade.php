<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500 text-3xl">
               <x-icons.icon-folders class="w-9 h-9"/>
            </span>
            {{ __('title.chapters') }}
        </h1>
    </div>

    <div>
        @livewire('admin.chapters.admin-chapter-livewire')
    </div>
</x-admin.admin-app-layout>



