<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class BookLivewire extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function likeBook(Book $book): void
    {
        $book->like ? $book->likes()->delete() : $book->likes()->create(['user_id' => auth()->id()]);
    }

    public function render(): View|Application|Factory
    {
        $books = Book::query()
            ->with(['user', 'likes'])
            ->where(function ($query) {
                $query->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(12);

        return view('book.livewire.book-livewire', compact('books'));
    }
}
