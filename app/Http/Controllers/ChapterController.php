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
     * @param string $slug
     * @return Application|Factory|View
     */
    public function index(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('book.show', [
            'book' => $book
        ]);
    }

    /**
     * @param string $slug
     * @return Application|Factory|View
     */
    public function create(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('chapter.create', [
            'book' => $book
        ]);
    }

    /**
     * @param ChapterRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function store(ChapterRequest $request, string $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        Chapter::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'image' => $request->get('image'),
            'description' => $request->get('description'),
            'book_id' => $book->id,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('book.chapter.index', ['slug' => $book->slug]);
    }

    public function edit(string $slug, string $slugChapter)
    {
        $book = Book::where('slug', '=', $slug)
            ->first();

        $chapter = Chapter::where('slug', '=', $slugChapter)
            ->first();

        return view('chapter.edit', compact('book', 'chapter'));
    }

    /**
     * @param ChapterRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(ChapterRequest $request, string $slug,)
    {
        $chapter = Chapter::where('slug', '=', $slug)->first();

        $chapter->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'image' => $request->get('image'),
            'description' => $request->get('description')
        ]);

        return redirect()->route('book.chapter.index', ['slug' => $chapter->book->slug]);
    }
}
