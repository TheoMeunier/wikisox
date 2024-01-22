<?php

namespace App\Services\FileSystem;

class FileSystemService
{
    public const PARENT_PATH = 'media/';

    public static function getImageName(string $link): ?string
    {
        $pattern = self::pattern();

        if (preg_match($pattern, $link, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private static function pattern(): string
    {
        $conf = config('filesystems.disks');

        if ($conf === 's3') {
            return '#/([^/]+)$#';
        }

        return '/storage\/(.*)/';
    }
}
