<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * @param  AdminUserRequest  $request
     * @return RedirectResponse
     */
    public function store(AdminUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $this->addRole($user, $request->get('role'));

        return redirect()
            ->route('admin.users.index')
            ->with('success', __('flash.user.create'));
    }

    /**
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * @param  AdminUserRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(AdminUserRequest $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $user->update([
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        if ($user->roles()->first() !== null) {
            $this->removeRole($user, $user->roles()->first());
        }

        $this->addRole($user, $request->get('role'));

        return redirect()
            ->route('admin.users.index')
            ->with('success', __('flash.user.update'));
    }

    /**
     * @param User $user
     * @param string $role
     * @return void
     */
    private function addRole (User $user, string $role): void
    {
        $role = Role::findOrFail($role);
        $user->assignRole($role);
    }

    /**
     * @param User $user
     * @param Role $role
     * @return void
     */
    private function removeRole (User $user, Role $role): void
    {
        $user->removeRole($role);
    }
}
