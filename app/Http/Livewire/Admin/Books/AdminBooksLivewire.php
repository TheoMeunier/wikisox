<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBooksLivewire extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View|Application|Factory
    {
        $books = Book::query()
            ->with(['user'])
            ->where(function ($query) {
                $query->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(6);

        return view('admin.books.livewire.admin-books-livewire', compact('books'));
    }
}
