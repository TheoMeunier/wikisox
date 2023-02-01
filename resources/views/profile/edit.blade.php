<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier mon profile
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h4>
                        <i class="fa-solid fa-user mr-3"></i>
                        {{ __('page/profile.title.information') }}
                    </h4>

                    <Profile-Edit/>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h4>
                    <i class="fa-solid fa-lock mr-3"></i>
                    {{ __('page/profile.title.password') }}
                </h4>

                <Profile-Password-Edit/>
            </div>
        </div>
    </div>
</x-app-layout>
