<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPagesLivewire extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @var string[]
     */
    protected $listeners = ['refresh-pages' => 'refreshPages'];

    public function refreshPages(): void
    {
        $this->render();
    }

    public function render(): View|Application|Factory
    {
        $pages = Page::query()
            ->with('user')
            ->where(function ($query) {
                $query->orWhere('name', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(6);

        return view('admin.pages.livewire.admin-pages-livewire', compact('pages'));
    }
}
