<?php

namespace App\Http\Livewire\Admin\Chapters\Modals;

use App\Models\Chapter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class AdminModalChapterDeleteLivewire extends ModalComponent
{
    public Chapter $chapter;

    public function destroy(): void
    {
        $this->chapter->delete();

        $this->emit('add-flash', 'success', __('flash.chapters.delete'));
        $this->emit('refresh-chapters');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.chapters.livewire.modals.admin-modal-chapter-delete-livewire');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
