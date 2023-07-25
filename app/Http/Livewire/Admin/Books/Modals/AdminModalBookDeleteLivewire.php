<?php

namespace App\Http\Livewire\Admin\Books\Modals;

use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AdminModalBookDeleteLivewire extends ModalComponent
{
    public Book $book;

    public function destroy(): void
    {
        $this->book->delete();

        $this->emit('add-flash', 'success', __('flash.books.delete'));
        $this->emit('refresh-books');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.books.livewire.modals.admin-modal-book-delete-livewire');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
