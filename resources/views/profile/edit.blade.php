<x-layouts.profile.layouts>
    <div>
        <h2 class="h4 mb-3 gap-3">
            <x-icons.icon-user/>
            {{ __('page/profile.information') }}
        </h2>

        @livewire('profile.profile-update-information-livewire')
    </div>


    <div class="mt-4">
        <h2 class="h4 mb-3 gap-3">
            <x-icons.icon-lock/>
            {{ __('page/profile.password') }}
        </h2>

        @livewire('profile.profile-update-password-livewire')
    </div>


    <div class="mt-4 mb-8">
        <h2 class="h4 mb-3 gap-3 text-danger">
            <x-icons.icon-trash class="w-6 h-6  icon-danger"/>
            {{ __('page/profile.delete-account') }}
        </h2>

        @livewire('profile.profile-delete-account-livewire')
    </div>
</x-layouts.profile.layouts>
