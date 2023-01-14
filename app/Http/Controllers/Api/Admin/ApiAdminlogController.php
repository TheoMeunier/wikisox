<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminLogResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Activitylog\Models\Activity;

class ApiAdminlogController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $logs = Activity::orderBy('created_at', 'DESC')->paginate(8);

        return AdminLogResource::collection($logs);
    }
}
