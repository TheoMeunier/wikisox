<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\ChapterResource;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Str;
use Symfony\Component\HttpFoundation\Request;

class ApiChapterController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $chapters = Chapter::where('name', 'LIKE', "%$request->q%")
            ->with(['auth', 'book', 'likes'])
            ->paginate(12);

        return ChapterResource::collection($chapters);
    }

    /**
     * @param  Chapter  $chapter
     * @return JsonResponse
     */
    public function like(Chapter $chapter)
    {
        $chapter->like ? $chapter->likes()->delete() : $chapter->likes()->create(['user_id' => auth()->id()]);

        return response()->json('ok');
    }

    /**
     * @param  string  $slug
     * @return JsonResponse
     */
    public function delete(string $slug)
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
