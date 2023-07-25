<?php

namespace App\Http\Livewire\Admin\Users\Modals;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class AdminModalUserDeleteLivewire extends ModalComponent
{
    public User $user;

    public function destroy(): void
    {
        $this->user->delete();

        $this->emit('add-flash', 'success', __('flash.users.delete'));
        $this->emit('refresh-users');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.users.livewire.modals.admin-modal-user-delete');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
