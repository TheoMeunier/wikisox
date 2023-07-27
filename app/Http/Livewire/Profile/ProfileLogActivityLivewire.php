<?php

namespace App\Http\Livewire\Profile;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileLogActivityLivewire extends Component
{
    use WithPagination;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View|Application|Factory
    {
        $logs = ActivityLog::query()
            ->with(['causer'])
            ->where('causer_id', '=', auth()->id())
            ->paginate(8);

        return view('profile.livewire.profile-log-activity-livewire', compact('logs'));
    }
}
