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

    public function edit(Book $book, Chapter $chapter)
    {
        return view('chapter.edit', compact($book, $chapter));
    }

    public function update(ChapterRequest $request, Chapter $chapter)
    {
        // TODO:: update chapter
    }
}
