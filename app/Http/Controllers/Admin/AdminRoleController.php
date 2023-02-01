<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionResource;
use App\Models\PermissionSystem;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = Role::with('relationResource', 'relationSystem')
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $systems   = PermissionSystem::all();
        $resources = PermissionResource::all();

        return view('admin.roles.create', compact('systems', 'resources'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $role = Role::with(['relationResource', 'relationSystem'])
            ->findOrFail($id);

        $systems = PermissionSystem::all();

        $resources = PermissionResource::all();

        return view('admin.roles.edit', compact('role', 'systems', 'resources'));
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $role = Role::create([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        foreach ($request->get('resources') ?: [] as $resource) {
            $role->relationResource()->attach($resource);
        }

        foreach ($request->get('systems') ?: [] as $system) {
            $role->relationSystem()->attach($system);
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
        dd($request);

        $role->update([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        foreach ($request->get('resources') ?: [] as $resource) {
            $role->relationResource()->attach($resource);
        }

        foreach ($request->get('systems') ?: [] as $system) {
            $role->relationSystem()->attach($system);
        }

        return redirect()->route('admin.roles.index');
    }
}
