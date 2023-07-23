<x-admin.admin-app-layout>
    <div class="flex justify-between items-center mb-7">
        <h1 class="flex items-center gap-3">
            <span class="text-indigo-500 text-3xl">
                <i class="fa-solid fa-image"></i>
            </span>
            {{ __('title.image') }}
        </h1>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <Admin-Images/>
        </div>
    </div>
</x-admin.admin-app-layout>



