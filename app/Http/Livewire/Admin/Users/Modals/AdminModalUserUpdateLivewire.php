<?php

namespace App\Http\Livewire\Admin\Users\Modals;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class AdminModalUserUpdateLivewire extends ModalComponent
{
    public User $user;
    public int $role_id;

    public Collection $roles;

    protected array $rules = [
        'user.name' => 'required|min:3',
        'user.email' => 'required|email',
        'role_id' => 'nullable',
    ];


    public function mount(): void
    {
        $this->roles = Role::all();
        $this->role_id = $this->user->roles->first()->id ?? 0;
    }

    public function update(): void
    {
        $this->validate();

        $this->user->update([
            'name' => $this->user->name,
            'email' => $this->user->email
        ]);

        $this->assigmentRoles();

        $this->emit('add-flash', 'success', __('flash.users.edit'));
        $this->emit('refresh-users');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.users.livewire.modals.admin-modal-user-update');
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    private function assigmentRoles(): void
    {
        $user = User::query()
            ->findOrFail($this->user->id);

        $role = Role::query()
            ->where('id', '=', $this->role_id)
            ->get();

        $userByRole = $this->user->roles->first();

        if (is_null($this->role_id)) {
            $user->assignRole($role);

        } else if ($this->role_id != $userByRole->id) {
            $user->removeRole($userByRole);
            $user->assignRole($role);
        }
    }
}
