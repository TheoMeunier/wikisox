<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiBookController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $books = Book::query()
            ->where('name', 'LIKE', "%$request->q%")
            ->with(['user', 'likes'])
            ->paginate(12);

        return BookResource::collection($books);
    }

    public function like(Book $book): JsonResponse
    {
        $book->like ? $book->likes()->delete() : $book->likes()->create(['user_id' => auth()->id()]);

        return response()->json('ok');
    }
}
