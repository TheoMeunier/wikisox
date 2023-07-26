<?php

namespace App\Http\Livewire\Admin\Pages\Modals;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class AdminModalPageDeleteLivewire extends ModalComponent
{
    public Page $page;

    public function destroy(): void
    {
        $this->page->delete();

        $this->emit('add-flash', 'success', __('flash.page.delete'));
        $this->emit('refresh-pages');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.pages.livewire.modals.admin-modal-page-delete-livewire');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
