<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookResource;
use App\Http\Resources\Admin\AdminChapterResource;
use App\Http\Resources\Admin\AdminPageResource;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Request;

class ApiAdminPageController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $pages = Page::with(['user', 'likes', 'chapter'])
            ->where('name','LIKE', "%$request->q%")
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        return AdminPageResource::collection($pages);
    }
}
