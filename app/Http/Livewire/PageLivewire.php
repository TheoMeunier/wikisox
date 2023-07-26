<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class PageLivewire extends Component
{
    use WithPagination;

    public string $search = '';

    public Chapter $chapter;

    public function render(): View|Application|Factory
    {
        $pages = Page::query()
            ->with(['user', 'chapter'])
            ->where('chapter_id', '=', $this->chapter->id)
            ->where(function ($query) {
                $query->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(12);

        return view('page.livewire.page-livewire', compact('pages'));
    }
}
