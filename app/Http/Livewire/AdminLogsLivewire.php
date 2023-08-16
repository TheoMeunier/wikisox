<?php

namespace App\Http\Livewire;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class AdminLogsLivewire extends Component
{
    use WithPagination;

    public function render(): View|Application|Factory
    {
        $logs = ActivityLog::query()
            ->with(['causer'])
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        return view('admin.logs.livewire.admin-logs-livewire', compact('logs'));
    }
}
