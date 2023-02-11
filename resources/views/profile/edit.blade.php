<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('page/profile.title') }}
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h4>
                <i class="fa-solid fa-user mr-3"></i>
                {{ __('page/profile.information') }}
            </h4>

            <Profile-Edit/>
        </div>
    </div>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h4>
                <i class="fa-solid fa-lock mr-3"></i>
                {{ __('page/profile.password') }}
            </h4>

            <Profile-Password-Edit/>
        </div>
    </div>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h4 class="text__danger">
                <i class="fa-solid fa-lock mr-3"></i>
                {{ __('page/profile.delete.title') }}
            </h4>

            <div class="mt-3">
                <p>{{ __('page/profile.delete.descriptionFirst') }}</p>
                <p>{{ __('page/profile.delete.descriptionSeconde') }}</p>
            </div>

            <div class="flex justify-end">
                <Delete-Account/>
            </div>
        </div>
    </div>
</x-app-layout>
