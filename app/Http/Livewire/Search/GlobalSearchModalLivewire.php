<?php

namespace App\Http\Livewire\Search;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class GlobalSearchModalLivewire extends ModalComponent
{
    public string $search = '';

    public array $searchResults = [];
    public int $totalResults = 0;
    public int $currentIndex = 0;

    public function incrementIndex(): void
    {
        if ($this->currentIndex === $this->totalResults - 1) {
            $this->currentIndex = 0;
        } else {
            $this->currentIndex++;
        }
    }

    public function decrementIndex(): void
    {
        if ($this->currentIndex === 0) {
            $this->currentIndex = $this->totalResults - 1;
        } else {
            $this->currentIndex--;
        }
    }

    public function selectIndex(): void
    {
        $this->redirect($this->searchResults[$this->currentIndex]['url']);
    }

    public function render(): View|Application|Factory
    {
        $this->searchResults = [];

        if (strlen($this->search) >= 2) {
            $query = Page::query()
                ->with('chapter.book')
                ->where('name', 'like', "%{$this->search}%");

            $this->totalResults = $query->get()->count();

            $query
                ->take(5)
                ->get()
                ->each(function ($item) {
                    $this->searchResults[] = [
                        'name' => $item['name'],
                        'url' => route('book.chapter.page.show', [
                            'slug' => $item['chapter']['book']['slug'],
                            'slugChapter' => $item['chapter']['slug'],
                            'slugPage' => $item['slug'],
                        ]),
                        'type' => 'Page',
                    ];
                });

        }

        return view('livewire.search.global-search-modal-livewire');
    }
}
