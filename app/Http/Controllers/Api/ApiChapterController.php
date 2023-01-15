<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class ApiChapterController extends Controller
{
    /**
     * @param Request $request
     * @param string $slug
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, string $slug)
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        $chapters = Chapter::where('book_id', '=', $book->id)
            ->where('name', 'LIKE', "%$request->q%")
            ->with(['user', 'likes'])
            ->paginate(12);

        return ChapterResource::collection($chapters);
    }

    /**
     * @param  Chapter  $chapter
     * @return JsonResponse
     */
    public function like(Chapter $chapter): JsonResponse
    {
        $chapter->like ? $chapter->likes()->delete() : $chapter->likes()->create(['user_id' => auth()->id()]);

        return response()->json('ok');
    }

    /**
     * @param  string  $slug
     * @return JsonResponse
     */
    public function delete(string $slug): JsonResponse
    {
        if ($slug) {
            $chapter = Chapter::where('slug', '=', $slug);

            if ($chapter !== null) {
                $chapter->delete();
                return response()->json('Chapter Deleted!');
            }
        }
        return response()->json('Error in your Deleted!');
    }
}
