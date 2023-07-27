<x-layouts.profile.layouts>
    <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="h4 mb-3">
                <i class="fa-solid fa-user mr-3 text-indigo-500"></i>
                {{ __('page/profile.information') }}
            </h1>

            @livewire('profile.profile-update-information-livewire')
        </div>
    </section>


    <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="h4 mb-3">
                <i class="fa-solid fa-lock mr-3 text-indigo-500"></i>
                {{ __('page/profile.password') }}
            </h1>

            @livewire('profile.profile-update-password-livewire')
        </div>
    </section>
</x-layouts.profile.layouts>
