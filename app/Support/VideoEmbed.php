<?php

namespace App\Support;

class VideoEmbed
{
    public static function resolve(?string $url): ?array
    {
        if (! $url) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return ['provider' => 'youtube', 'embedUrl' => "https://www.youtube.com/embed/{$matches[1]}"];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return ['provider' => 'vimeo', 'embedUrl' => "https://player.vimeo.com/video/{$matches[1]}"];
        }

        return ['provider' => 'file', 'embedUrl' => $url];
    }
}
