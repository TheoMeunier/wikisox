<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiAdminBookController extends Controller
{
    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $books = Book::query()
            ->with(['user', 'likes'])
            ->where('name', 'LIKE', "%$request->q%")
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        return AdminBookResource::collection($books);
    }

    /**
     * @param string $slug
     * @return JsonResponse
     */
    public function delete (string $slug)
    {
        $book = Book::query()
            ->where('slug', '=', $slug)
            ->firstOrFail();

        $book->delete();

        return response()->json('Chapter delete');
    }
}
