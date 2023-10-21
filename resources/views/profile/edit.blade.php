<x-layouts.profile.layouts>
    <div>
        <h1 class="h4 mb-3 gap-3">
            <x-icons.icon-user/>
            {{ __('page/profile.information') }}
        </h1>

        @livewire('profile.profile-update-information-livewire')
    </div>


    <div class="mt-4">
        <h1 class="h4 mb-3 gap-3">
            <x-icons.icon-lock/>
            {{ __('page/profile.password') }}
        </h1>

        @livewire('profile.profile-update-password-livewire')
    </div>
</x-layouts.profile.layouts>
