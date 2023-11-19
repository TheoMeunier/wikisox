<?php

namespace App\Http\Livewire\Search;

use App\Services\SearchService;
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
        if ($this->currentIndex === 4) {
            $this->currentIndex = 0;
        } else {
            $this->currentIndex++;
        }
    }

    public function decrementIndex(): void
    {
        if ($this->currentIndex === 0) {
            $this->currentIndex = 4;
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
        $query = new SearchService();

        if ($this->search >= 2) {
            $data = $query->search($this->search, true);

            $this->searchResults = $data['results'];
            $this->totalResults  = $data['totalResults'];
        }

        return view('livewire.search.global-search-modal-livewire');
    }
}
