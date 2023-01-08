<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\ChapterResource;
use App\Http\Resources\PageResource;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Str;
use Symfony\Component\HttpFoundation\Request;

class ApiPageController extends Controller
{
    /**
     * @param Request $request
     * @param string $slug
     * @param string $slugChapter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, string $slug, string $slugChapter)
    {
        $chapter = Chapter::where('slug', '=', $slugChapter)->first();

        $pages = Page::where('chapter_id', '=', $chapter->id)
            ->where('name', 'LIKE', "%$request->q%")
            ->with(['user', 'likes'])
            ->paginate(12);

        return PageResource::collection($pages);
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
            $chapter = Page::where('slug', '=', $slug);

            if ($chapter !== null) {
                $chapter->delete();
                return response()->json('Page Deleted!');
            }
        }
        return response()->json('Error in your Deleted!');
    }
}
