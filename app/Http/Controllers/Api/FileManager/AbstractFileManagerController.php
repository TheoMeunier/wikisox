<?php

namespace App\Http\Controllers\Api\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class AbstractFileManagerController extends Controller
{
    protected function filesysteme(): Filesystem
    {
        return Storage::disk('media');
    }
}
