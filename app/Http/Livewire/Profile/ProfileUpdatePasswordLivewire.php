<?php

namespace App\Http\Livewire\Profile;

use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ProfileUpdatePasswordLivewire extends Component
{
    public string $password;

    public string $password_confirmation;

    protected array $rules = [
        'password' => 'required|min:6|confirmed',
    ];

    public function updatePassword(): void
    {
        $this->validate();

        auth()->user()?->update([
            'password' => Hash::make($this->password),
        ]);

        $this->emit('add-flash', 'success', __('flash.profile.update_password'));
    }

    public function render(): View|Application|Factory
    {
        return view('profile.livewire.profile-update-password-livewire');
    }
}