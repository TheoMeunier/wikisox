<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ApiAdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['role'])
            ->where(function ($query) use ($request) {
                $query->orWhere('name', 'LIKE', "%$request->q%")
                    ->orWhere('email', 'LIKE', "%$request->q%");
            })
            ->paginate(8);

        return AdminUserResource::collection($users);
    }
}
