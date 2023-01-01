<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Str;
use Symfony\Component\HttpFoundation\Request;

class ApiBookController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $books = Book::where('name', 'LIKE', "%$request->q%")
            ->paginate(12);

        return BookResource::collection($books);
    }

    /**
     * @param  Book  $book
     * @return JsonResponse
     */
    public function like(Book $book)
    {
        $book->like ? $book->likes()->delete() : $book->likes()->create(['user_id' => auth()->id()]);

        return response()->json('ok');
    }

    /**
     * @param  string  $slug
     * @return JsonResponse
     */
    public function delete(string $slug)
    {
        if ($slug) {
            $book = Book::where('slug', '=', $slug);

            if ($book !== null) {
                $book->delete();
                return response()->json('Book Deleted!');
            }
        }
        return response()->json('Error in your Deleted!');
    }
}
