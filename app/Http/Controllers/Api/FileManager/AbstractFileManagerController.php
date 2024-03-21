<?php

namespace App\Http\Controllers\Api\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class AbstractFileManagerController extends Controller
{
    protected function filesysteme(): Filesystem
    {
        $conf = config('filesystems.default');

        if ($conf === 's3') {
            return Storage::disk('s3-media');
        } else {
            return Storage::disk('media');
        }
    }

    protected function getFilesystem(): string
    {
        $conf = config('filesystems.default');

        if ($conf === 's3') {
            return 's3-media';
        } else {
            return 'media';
        }
    }

    protected function getUrlLink(string $file): string
    {
        $conf = config('filesystems.default');

        if ($conf === 's3') {
            return $this->filesysteme()->temporaryUrl($file, now()->addMinutes(5));
        } else {
            return $this->filesysteme()->url($file);
        }
    }
}
