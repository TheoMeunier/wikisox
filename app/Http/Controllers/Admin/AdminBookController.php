<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;

class AdminBookController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.books.index');
    }

    /**
     * @param  string  $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        return view('admin.books.edit', compact('book'));
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
            ->route('admin.book.index')
            ->with('success', __('flash.book.update'));
    }
}
