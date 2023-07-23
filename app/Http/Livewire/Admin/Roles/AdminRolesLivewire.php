<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AdminRolesLivewire extends Component
{
    public function render(): View|Application|Factory
    {
        $roles = Role::all();

        return view('admin.roles.livewire.admin-roles-livewire', compact('roles'));
    }
}
