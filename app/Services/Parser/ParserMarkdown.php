<?php

namespace App\Services\Parser;

use App\Services\Glide\GlideImageService;
use Parsedown;

class ParserMarkdown
{
    public function markdown(?string $content): string
    {
        if ($content === null) {
            return '';
        }

        $content = (new Parsedown())
            ->setBreaksEnabled(true)
            ->setSafeMode(false)
            ->text($content);

        //parse note (warning, info, danger)
        $content = (string) preg_replace_callback(
            '/(?:<p>\s*)?:::(warning|info|danger)\s*(.*?)\s*:::(?:<\/p>\s*)?/s',
            function ($matches) {
                $icon  = $this->getIcon($matches[1]);
                $class = 'message message-'.$matches[1];

                return '<div class="'.$class.'">'
                    .$icon.$matches[2].'</div>';
            },
            $content
        );

        //Parser image:
        $content = (string) preg_replace_callback(
            '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/',
            function ($matches) {
                $image = $matches[1];
                $link  = $this->glideUrl($image);

                return '<img src="'.$link.'" alt="'.$image.'">';
            },
            $content
        );

        return $content;
    }

    private function getIcon(string $type): string
    {
        $icons = [
            'warning' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-warning">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
</svg>',
            'info' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-info">
    <circle cx="12" cy="12" r="10"/>
    <line x1="12" x2="12" y1="8" y2="12"/>
    <line x1="12" x2="12.01" y1="16" y2="16"/>
</svg>',
            'danger' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-danger">
    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"/>
    <path d="m15 9-6 6"/>
    <path d="m9 9 6 6"/>
</svg>',
        ];

        return $icons[$type];
    }

    private function glideUrl(string $image): string
    {
        return GlideImageService::getLinkImage($image);
    }
}
