<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Laracsv\Export;
use League\Csv\CannotInsertRecord;
use League\Csv\InvalidArgument;

class AdminlogController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.logs.index');
    }

    /**
     * @throws InvalidArgument
     */
    public function export(): void
    {
        try {
            $export = new Export();
            $export
                ->getWriter()
                ->setDelimiter(";");

            $export
                ->build(ActivityLog::all(),
                    ['id', 'log_name', 'description', 'subject_type', 'event', 'subject_id', 'causer_type', 'causer_id', 'properties', 'batch_uuid', 'created_at', 'updated_at'],
                    ['chunk' => 500])
                ->download('wiki_logs.csv');

        } catch (CannotInsertRecord $e) {
            Log::error($e->getMessage());
        }
    }
}
