<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('page/profile.title') }}
        </div>
    </x-slot>

    <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="h4">
                <i class="fa-solid fa-user mr-3"></i>
                {{ __('page/profile.information') }}
            </h1>

            <Profile-Edit/>
        </div>
    </section>


    <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="h4">
                <i class="fa-solid fa-lock mr-3"></i>
                {{ __('page/profile.password') }}
            </h1>

            <Profile-Password-Edit/>
        </div>
    </section>
</x-app-layout>
