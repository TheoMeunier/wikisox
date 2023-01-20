<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Http\Resources\Admin\AdminUserResource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
        return view("admin.users.create");
    }

    /**
     * @param AdminUserRequest $request
     * @return RedirectResponse
     */
    public function store(AdminUserRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param AdminUserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AdminUserRequest $request, int $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return redirect()->route('admin.users.index');
    }
}
