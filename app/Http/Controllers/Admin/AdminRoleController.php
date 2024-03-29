<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRoleRequest;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class AdminRoleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $permissions = Permission::all()->pluck('name', 'id');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $role        = Role::findOrFail($id);
        $permissions = Permission::all()->pluck('name', 'id');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function store(AdminRoleRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->get('name'),
        ]);

        if ($request->get('permissions') !== null) {
            $role->syncPermissions($request->get('permissions'));
        }

        return redirect()->route('admin.roles.index')
            ->with('success', __('flash.roles.create'));
    }

    public function update(AdminRoleRequest $request, int $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->get('name'),
        ]);

        $role->syncPermissions($request->get('permissions'));

        return redirect()->route('admin.roles.index')
            ->with('success', __('flash.roles.update'));
    }
}
