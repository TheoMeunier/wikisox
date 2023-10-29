<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-icons.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="my-8 text-center">
            <h1>IsoxBook</h1>
        </div>

        <div class="mb-4 mt-6 text-sm text-gray-600 text-center">
            {{ __('Votre Mot de passe à bien été modifier') }}
        </div>
    </x-auth-card>
</x-guest-layout>
