<?php

namespace App\Http\Livewire\Admin\Users\Modals;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class AdminModalUserCreateLivewire extends ModalComponent
{
    public string $name, $email, $password, $password_confirmation;
    public int $role_id;
    public Collection $roles;

    protected  $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
        'role_id' => 'required'
    ];

    public function mount(): void
    {
        $this->roles = Role::all();
    }

    public function save(): void
    {
        //TODO :: Add option for choice send mail with password or form password

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $role = Role::query()
            ->where('id', '=', $this->role_id)
            ->get();

        $user->assignRole($role);

        $this->emit('add-flash', 'success', __('flash.users.create'));
        $this->emit('refresh-users');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.users.livewire.modals.admin-modal-user-create');
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
}
