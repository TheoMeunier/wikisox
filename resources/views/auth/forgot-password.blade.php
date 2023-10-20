<x-guest-layout>
    <section class="flex items-center justify-around">
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-icons.application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('auth.text.changePassword') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('input.label.email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="flex items-center mt-4">
                    <x-button>
                        {{ __('button.action.updatePassword') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>

        <div class="w-2/4">
            <img src="{{ asset('images/logo_password.svg') }}" alt="forgot password">
        </div>
    </section>
</x-guest-layout>
