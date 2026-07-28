<?php

namespace App\Support;

use BladeUI\Icons\Factory;
use BladeUI\Icons\IconsManifest;
use Illuminate\Support\Facades\Cache;

class IconLibrary
{
    public static function brandIcons(): array
    {
        return ['link', ...config('builder.social_networks', [])];
    }

    public static function lucideIcons(): array
    {
        return Cache::rememberForever('icon-library:lucide', function () {
            $factory = app(Factory::class);
            $manifest = app(IconsManifest::class);

            $icons = $manifest->getManifest($factory->all())['lucide'] ?? [];

            return collect($icons)->flatten()->sort()->values()->all();
        });
    }

    public static function search(string $term, int $limit = 60): array
    {
        $term = trim(strtolower($term));

        $brand = collect(self::brandIcons())
            ->when($term !== '', fn ($icons) => $icons->filter(fn ($name) => str_contains($name, $term)))
            ->values();

        $lucide = collect(self::lucideIcons())
            ->when($term !== '', fn ($icons) => $icons->filter(fn ($name) => str_contains($name, $term)))
            ->take($limit)
            ->map(fn ($name) => "lucide:{$name}");

        return $brand->merge($lucide)->all();
    }
}
