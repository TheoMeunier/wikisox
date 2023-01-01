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

    public function create()
    {
        return view('book.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
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

    public function edit(Book $book)
    {
        return view('book.edit');
    }

    public function update(Request $request, Book $book)
    {
        Book::update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'image' => $request->get('image'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('book.chapter.index', ['book' => $book]);
    }
}
