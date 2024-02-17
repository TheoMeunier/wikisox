<?php

namespace App\Http\Livewire\Pages\Modals;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class PageShareModalLivewire extends ModalComponent
{
    public Page $page;

    public string $token;

    public string $link;

    public int $hour = 1;

    public bool $is_exist;

    public function mount(): void
    {
        $this->is_exist = $this->isExistLinkShare();
        $this->token    = Str::random(64);
        $this->link     = route('pages.share', $this->token);
    }

    public function createShare(): void
    {
        $this->page->share_page       = $this->token;
        $this->page->share_expired_at = Carbon::now()->addHours($this->hour);
        $this->page->save();

        $this->emit('add-flash', 'success', __('flash.page.share'));
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('page.livewire.share.modals.page-share-modal-livewire');
    }

    private function isExistLinkShare(): bool
    {
        if ($this->page->share_page !== null && $this->page->share_expired_at > Carbon::now()) {
            return true;
        }

        return false;
    }
}
