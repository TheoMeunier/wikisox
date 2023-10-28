<?php

namespace App\Http\Livewire\Admin\Logs\Modals;

use App\Enum\ModelsEnum;
use App\Models\ActivityLog;
use App\Services\RestoreDataService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class AdminLogsModalsRestoreLivewire extends ModalComponent
{
    public string $type;

    public ActivityLog $log;

    public function mount(): void
    {
        $this->type = $this->log->subject_type ?? '';
    }

    public function restore(): void
    {
        $restoreDataService = new RestoreDataService();

        if ($this->log->subject_id) {
            if ($this->type === ModelsEnum::PAGE) {
                $restoreDataService->restorePage($this->log->subject_id);
            } elseif ($this->type === ModelsEnum::CHAPTER) {
                $restoreDataService->restoreChapter($this->log->subject_id);
            } elseif ($this->type === ModelsEnum::BOOK) {
                $restoreDataService->restoreBook($this->log->subject_id);
            } elseif ($this->type === ModelsEnum::USER) {
                $restoreDataService->restoreUser($this->log->subject_id);
            }
        }

        $this->emit('add-flash', 'success', __('flash.logs.restore'));
        $this->emit('refresh-logs');
        $this->closeModal();
    }

    public function render(): View|Application|Factory
    {
        return view('admin.logs.livewire.modals.logs-modals-restore-livewire');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }
}
