<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiProfileController extends Controller
{
    public function uploadAvatar(Request $request): JsonResponse
    {
        $file = $request->file('avatar');
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $path = $file->storeAs('/avatar',$filename . '_' . $file->hashName(), 'public');

        $user = auth()->user();

        if ($user) {
            $user->update([
                'avatar' => $path
            ]);
        }

        return response()->json([
            'path' => Storage::url($path)
        ]);
    }
}
