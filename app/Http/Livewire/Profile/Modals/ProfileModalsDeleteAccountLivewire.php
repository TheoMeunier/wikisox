<?php

namespace App\Http\Livewire\Profile\Modals;

use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ProfileModalsDeleteAccountLivewire extends ModalComponent
{
    public string $password;

    protected array $rules = [
        'password' => 'required',
    ];

    public function delete(): void
    {
        $this->validate();

        if (auth()->user()) {
            if (Hash::check($this->password, auth()->user()->password)) {
                auth()->user()->delete();
                auth()->logout();

                $this->redirect('/');
            } else {
                $this->emit('add-flash', 'danger', __('flash.profile.delete_error'));
                $this->closeModal();
            }
        }
    }

    public function render(): View|Application|Factory
    {
        return view('profile.livewire.modals.profile-modals-delete-account-livewire');
    }
}
