<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookResource;
use App\Http\Resources\Admin\AdminChapterResource;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Request;

class ApiAdminChapterController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $chapters = Chapter::with(['user', 'likes', 'book'])
            ->where('name','LIKE', "%$request->q%")
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        return AdminChapterResource::collection($chapters);
    }
}
