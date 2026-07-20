<?php

namespace App\Support;

class ReferrerClassifier
{
    public static function classify(?string $referrer): string
    {
        if (! $referrer) {
            return 'Direct';
        }

        $host = strtolower(parse_url($referrer, PHP_URL_HOST) ?? '');

        if ($host === '') {
            return 'Direct';
        }

        foreach (self::domainMap() as $needle => $platform) {
            if (str_contains($host, $needle)) {
                return $platform;
            }
        }

        return $host;
    }

    protected static function domainMap(): array
    {
        return [
            'instagram.com' => 'Instagram',
            'instagr.am' => 'Instagram',
            'tiktok.com' => 'TikTok',
            'x.com' => 'X',
            'twitter.com' => 'X',
            't.co' => 'X',
            'youtube.com' => 'YouTube',
            'youtu.be' => 'YouTube',
            'facebook.com' => 'Facebook',
            'fb.me' => 'Facebook',
            'google.' => 'Google',
            'pinterest.' => 'Pinterest',
            'linkedin.com' => 'LinkedIn',
            'reddit.com' => 'Reddit',
        ];
    }
}
