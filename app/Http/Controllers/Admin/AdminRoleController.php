<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $permissions   = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $role = Role::create([
            'name'        => $request->get('name'),
        ]);

        foreach ($request->get('permissions') ?: [] as $permission) {
           $role->givePermissionTo($permission);
        }

        return redirect()->route('admin.roles.index');
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name'        => $request->get('name'),
        ]);

        foreach ($request->get('resources') ?: [] as $resource) {
            $role->relationResource()->attach($resource);
        }

        return redirect()->route('admin.roles.index');
    }
}
