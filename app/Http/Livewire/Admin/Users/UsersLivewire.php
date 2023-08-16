<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class UsersLivewire extends Component
{
    use WithPagination;

    public string $search = '';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh-users' => 'refreshUser'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function refreshUser(): void
    {
        $this->render();
    }

    public function render(): View|Application|Factory
    {
        $users = User::query()
            ->with(['roles'])
            ->where(function ($query) {
                $query->orWhere('name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('email', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(8);

        return view('admin.users.livewire.admin-users-livewire', compact('users'));
    }
}
