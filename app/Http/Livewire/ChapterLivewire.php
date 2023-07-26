<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ChapterLivewire extends Component
{
    use WithPagination;

    public string $search = '';

    public Book $book;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function likeChapter(Chapter $chapter): void
    {
        $chapter->like ? $chapter->likes()->delete() : $chapter->likes()->create(['user_id' => auth()->id()]);
    }

    public function render(): View|Application|Factory
    {
        $chapters = Chapter::query()
            ->with(['user', 'likes', 'book'])
            ->where('book_id', '=', $this->book->id)
            ->where(function ($query) {
                $query->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(12);

        return view('chapter.livewire.chapter-livewire', compact('chapters'));
    }
}
