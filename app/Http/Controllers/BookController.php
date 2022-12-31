<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

    public function store(Request $request)
    {
        //TODO:: Create books
    }

    public function edit(Book $book)
    {
        return view('book.edit');
    }

    public function update(Request $request, Book $book)
    {
        //TODO:: Update book
    }
}
