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
        $files = $request->file('avatar');

        if (is_array($files)) {
            foreach ($files as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $path     = $file->storeAs('avatar', $filename.'_'.$file->hashName(), 'public');

                if ($path) {
                    auth()->user()?->update([
                        'avatar' => $path,
                    ]);

                    return response()->json([
                        'path' => Storage::url($path),
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Le fichier n\'a pas été correctement téléchargé',
                    ], 400);
                }
            }
        }

        return response()->json([
            'error' => 'Le fichier n\'a pas été correctement téléchargé',
        ], 400);
    }
}
