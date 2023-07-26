<?php

namespace App\Http\Livewire\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class FlashMessageLivewire extends Component
{
    public array $flashs = [];

    /**
     * @var string[]
     */
    protected $listeners = ['add-flash' => 'showFlash'];

    public function showFlash(string $status, string $message): void
    {
        $this->flashs[] = [
            'status'  => $status,
            'message' => $message,
        ];
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.layouts.flash-message-livewire');
    }
}
