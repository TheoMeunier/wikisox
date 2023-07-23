<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class AdminRolesLivewire extends Component
{
    public function render()
    {
        $roles = Role::all();

        return view('admin.roles.livewire.admin-roles-livewire', compact('roles'));
    }
}
