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

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $books = Book::where('name', 'LIKE', "%$request->q%")
            ->with(['user', 'likes'])
            ->paginate(12);

        return BookResource::collection($books);
    }

    /**
     * @param  Book  $book
     * @return JsonResponse
     */
    public function like(Book $book): JsonResponse
    {
        $book->like ? $book->likes()->delete() : $book->likes()->create(['user_id' => auth()->id()]);

        return response()->json('ok');
    }

    /**
     * @param  string  $slug
     * @return JsonResponse|RedirectResponse
     */
    public function delete(string $slug)
    {
        if ($slug) {
            $book = Book::where('slug', '=', $slug);

            if ($book !== null) {
                $book->delete();
                return redirect()->route('book.index');
            }
        }
        return response()->json('Error in your Deleted!');
    }
}
