<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterRequest;
use App\Models\Book;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function index(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('book.show', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('chapter.create', compact($book));
    }

    public function store(ChapterRequest $request, Book $book)
    {
        // TODO:: create chapter
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
