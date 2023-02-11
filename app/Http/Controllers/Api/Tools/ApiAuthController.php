<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    /**
     * @return AuthResource
     */
    public function index(): AuthResource
    {
        $user = User::query()
            ->where('id', '=', Auth::id())
            ->firstOrFail();

        return AuthResource::make($user);
    }
}
