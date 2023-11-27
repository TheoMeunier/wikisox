<?php

namespace App\Http\Livewire\Search;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class GlobalSearchLivewire extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.search.global-search-livewire');
    }
}
