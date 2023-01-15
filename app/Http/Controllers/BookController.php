<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('book.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Book::create([
           'name' => $request->get('name'),
           'slug' => Str::slug($request->get('name')),
           'image' => $request->get('image'),
           'description' => $request->get('description'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('book.index');
    }

    /**
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $book = Book::where('slug' , '=', $slug)->firstOrFail();

        return view('book.edit', [
            'book' => $book
        ]);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(Request $request, string $slug): RedirectResponse
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        $book->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'image' => $request->get('image'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('book.chapter.index', ['slug' => $book->slug]);
    }
}
