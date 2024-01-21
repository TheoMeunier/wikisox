<?php

namespace App\Trait\Model;

use App\Services\Glide\GlideImageService;

trait ImageTrait
{
    public function getImageUrl(?int $width = null, ?int $height = null): ?string
    {
        if ($this->image) {
            return GlideImageService::getLinkImage($this->image, $width, $height);
        }

        return null;
    }
}
