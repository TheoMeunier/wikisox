<?php

namespace App\Http\Livewire\Pages;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class PageShareLivewire extends Component
{
    public Page $page;

    public function render(): View|Application|Factory
    {
        return view('page.livewire.share.page-share-livewire');
    }
}
