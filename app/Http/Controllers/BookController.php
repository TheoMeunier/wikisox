<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\FileSystem\FileSystemService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;

class BookController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $books = Book::query()->count();

        return view('book.index', compact('books'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('book.create');
    }

    public function store(BookRequest $request): RedirectResponse
    {
        Book::create([
            'name'        => $request->get('name'),
            'slug'        => Str::slug($request->get('name')),
            'image'       => $request->get('image'),
            'description' => $request->get('description'),
            'user_id'     => auth()->id(),
        ]);

        return redirect()
            ->route('book.index')
            ->with('success', __('flash.book.create'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        return view('book.edit', compact('book'));
    }

    public function update(BookRequest $request, string $slug): RedirectResponse
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        $book->update([
            'name'        => $request->get('name'),
            'slug'        => Str::slug($request->get('name')),
            'image'       => $request->get('image'),
            'description' => $request->get('description'),
        ]);

        return redirect()
            ->route('book.chapter.index', ['slug' => $book->slug])
            ->with('success', __('flash.book.update'));
    }

    public function delete(string $slug): RedirectResponse
    {
        $book = Book::query()->where('slug', '=', $slug)->firstOrFail();
        $book->delete();

        return redirect()
            ->route('book.index')
            ->with('success', __('flash.book.delete'));
    }
}
