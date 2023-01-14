<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ApiTransController extends Controller
{
    /**
     * Auto-invoke and return files lang.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $strings = Cache::remember('lang.js', (in_array(config('app.env'), ['production', 'staging'])) ? 300 : 0, function () {
            $lang = config('app.locale');

            /** @var array $files */
            $files   = glob(resource_path('lang/'.$lang.'/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name       = basename($file, '.php');
                $arrayTrans = require $file;

                $strings[$name] = recursive_array_replace(':app_name', config('app.name'), $arrayTrans);
            }

            return $strings;
        });

        return response()->json($strings);
    }
}
