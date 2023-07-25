<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ProfileUpdateInformationLivewire extends Component
{
    public string $name;

    public string $email;

    protected array $rules = [
        'name'  => 'min:3|required',
        'email' => 'required|required',
    ];

    public function mount(): void
    {
        $this->name  = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function updateInformation(): void
    {
        $this->validate();

        auth()->user()?->update([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        $this->emit('add-flash', 'success', __('flash.profile.update_password'));
    }

    public function render(): View|Application|Factory
    {
        return view('profile.livewire.profile-update-information-livewire');
    }
}
