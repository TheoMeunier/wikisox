<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
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

    /**
     * @param  BookRequest  $request
     * @return RedirectResponse
     */
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
     * @param  string  $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        return view('book.edit', compact('book'));
    }

    /**
     * @param  BookRequest  $request
     * @param  string  $slug
     * @return RedirectResponse
     */
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

    /**
     * @param  string  $slug
     * @return RedirectResponse
     */
    public function delete(string $slug): RedirectResponse
    {
        $book = Book::query()->where('slug', '=', $slug)->firstOrFail();
        $book->delete();

        return redirect()
            ->route('book.index')
            ->with('success', __('flash.book.delete'));
    }
}
