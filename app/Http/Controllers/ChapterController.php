<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterRequest;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;

class ChapterController extends Controller
{
    /**
     * @param  string  $slug
     * @return Application|Factory|View
     */
    public function index(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('book.show', compact('book'));
    }

    /**
     * @param  string  $slug
     * @return Application|Factory|View
     */
    public function create(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('chapter.create', compact('book'));
    }

    /**
     * @param  ChapterRequest  $request
     * @param  string  $slug
     * @return RedirectResponse
     */
    public function store(ChapterRequest $request, string $slug): RedirectResponse
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        Chapter::create([
            'name'        => $request->get('name'),
            'slug'        => Str::slug($request->get('name')),
            'image'       => $request->get('image'),
            'description' => $request->get('description'),
            'book_id'     => $book->id,
            'user_id'     => auth()->id(),
        ]);

        return redirect()
            ->route('book.chapter.index', ['slug' => $book->slug])
            ->with('success', __('flash.chapter.create'));
    }

    /**
     * @param  string  $slug
     * @param  string  $slugChapter
     * @return Application|Factory|View
     */
    public function edit(string $slug, string $slugChapter)
    {
        $book = Book::where('slug', '=', $slug)
            ->first();

        $chapter = Chapter::where('slug', '=', $slugChapter)
            ->first();

        return view('chapter.edit', compact('book', 'chapter'));
    }

    /**
     * @param  ChapterRequest  $request
     * @param  string  $slug
     * @return RedirectResponse
     */
    public function update(ChapterRequest $request, string $slug): RedirectResponse
    {
        $chapter = Chapter::with('book')
            ->where('slug', '=', $slug)->firstOrFail();

        $chapter->update([
            'name'        => $request->get('name'),
            'slug'        => Str::slug($request->get('name')),
            'image'       => $request->get('image'),
            'description' => $request->get('description'),
        ]);

        return redirect()
            ->route('book.chapter.index', ['slug' => $chapter->book->slug])
            ->with('success', __('flash.chapter.update'));
    }

    /**
     * @param string $slug
     * @return RedirectResponse
     */
    public function delete(string $slug): RedirectResponse
    {
        $chapter = Chapter::query()->where('slug', '=', $slug)->firstOrFail();
        $chapter->delete();

        return redirect()
            ->route('book.chapter.index', ['slug' => $chapter->book->slug])
            ->with('success', __('flash.chapter.delete'));
    }
}
