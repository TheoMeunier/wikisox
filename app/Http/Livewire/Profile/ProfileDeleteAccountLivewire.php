<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ProfileDeleteAccountLivewire extends Component
{
    public function render(): View|Application|Factory
    {
        return view('profile.livewire.profile-delete-account-livewire');
    }
}
