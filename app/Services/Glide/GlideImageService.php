<?php

namespace App\Services\Glide;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemOperator;
use League\Glide\Urls\UrlBuilderFactory;

class GlideImageService
{
    public static function getLinkImage(string $image, ?int $width = null, ?int $height = null): string
    {
        $urlBuilder = UrlBuilderFactory::create('/images/', config('glide.key'));

        return $urlBuilder->getUrl($image, ['w' => $width, 'h' => $height, 'fit' => 'crop']);
    }

    public static function getDriver(): FilesystemOperator
    {
        $conf = config('filesystems.default');

        if ($conf === 's3') {
            return Storage::disk('s3-media')->getDriver();
        }

        return Storage::disk('media')->getDriver();
    }
}
