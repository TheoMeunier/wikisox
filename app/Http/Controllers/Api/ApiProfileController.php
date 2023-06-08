<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UpdatePassword;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ApiProfileController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'name'  => 'required|min:4',
            'email' => 'required|email',
        ]);

        $user = User::where('id', '=', auth()->id())->firstOrFail();

        $user->update([
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return response()->json([
            'message' => 'Profile updated successfully',
        ], Response::HTTP_OK);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('id', '=', auth()->id())->firstOrFail();

        $user->update([
            'password' => Hash::make($request->get('password')),
        ]);

        Mail::to($user->email)->send(new UpdatePassword());

        return response()->json([
            'message' => 'Password updated successfully',
        ], Response::HTTP_OK);
    }
}
