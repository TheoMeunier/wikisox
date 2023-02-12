<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminPageResource;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiAdminPageController extends Controller
{
    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $pages = Page::query()
            ->with(['user', 'likes', 'chapter'])
            ->where('name', 'LIKE', "%$request->q%")
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        return AdminPageResource::collection($pages);
    }

    /**
     * @param string $slug
     * @return JsonResponse
     */
    public function delete(string $slug): JsonResponse
    {
        $page = Page::query()->where('slug', $slug)->firstOrFail();
        $page->delete();

        return response()->json(['message' => 'Page deleted']);
    }
}
