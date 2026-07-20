<?php

namespace App\Support;

class ThemePresets
{
    public static function all(): array
    {
        return array_map(
            fn (array $preset) => array_merge($preset, ['tokens' => self::mergeTokens($preset['tokens'])]),
            self::raw()
        );
    }

    public static function default(): array
    {
        return self::mergeTokens(self::raw()[0]['tokens']);
    }

    public static function find(string $slug): ?array
    {
        foreach (self::raw() as $preset) {
            if ($preset['slug'] === $slug) {
                return array_merge($preset, ['tokens' => self::mergeTokens($preset['tokens'])]);
            }
        }

        return null;
    }

    protected static function base(): array
    {
        return [
            'colors' => [
                'primary' => '#6366f1',
                'secondary' => '#8b5cf6',
                'accent' => '#ec4899',
                'background' => '#f8fafc',
                'surface' => '#ffffff',
                'text' => '#111827',
                'border' => '#e5e7eb',
            ],
            'typography' => [
                'fontFamily' => 'Instrument Sans',
                'fontSize' => 15,
                'fontWeight' => 'medium',
                'letterSpacing' => 0,
                'lineHeight' => 1.5,
            ],
            'buttons' => [
                'radius' => 16,
                'height' => 48,
                'shadow' => 'soft',
                'style' => 'filled',
                'fullWidth' => true,
            ],
            'background' => [
                'type' => 'solid',
                'value' => '#f8fafc',
            ],
            'cards' => [
                'radius' => 16,
                'shadow' => 'soft',
                'padding' => 16,
                'spacing' => 12,
            ],
            'animations' => [
                'hoverScale' => true,
                'hoverLift' => true,
                'fade' => true,
                'slide' => false,
            ],
        ];
    }

    protected static function mergeTokens(array $overrides): array
    {
        return array_replace_recursive(self::base(), $overrides);
    }

    protected static function raw(): array
    {
        return [
            [
                'slug' => 'minimal-white',
                'name' => 'Minimal White',
                'pro' => false,
                'tokens' => [],
            ],
            [
                'slug' => 'modern-dark',
                'name' => 'Modern Dark',
                'pro' => false,
                'tokens' => [
                    'colors' => [
                        'primary' => '#818cf8', 'secondary' => '#a78bfa', 'accent' => '#f472b6',
                        'background' => '#0f172a', 'surface' => '#1e293b', 'text' => '#f1f5f9', 'border' => '#334155',
                    ],
                    'background' => ['type' => 'solid', 'value' => '#0f172a'],
                ],
            ],
            [
                'slug' => 'glassmorphism',
                'name' => 'Glassmorphism',
                'pro' => true,
                'tokens' => [
                    'colors' => [
                        'primary' => '#60a5fa', 'secondary' => '#38bdf8', 'accent' => '#a78bfa',
                        'background' => '#e0e7ff', 'surface' => 'rgba(255,255,255,0.55)', 'text' => '#1e293b', 'border' => 'rgba(255,255,255,0.4)',
                    ],
                    'buttons' => ['style' => 'outline', 'radius' => 20, 'shadow' => 'soft'],
                    'background' => ['type' => 'gradient', 'value' => 'linear-gradient(135deg, #c7d2fe, #fbcfe8)'],
                ],
            ],
            [
                'slug' => 'gradient-purple',
                'name' => 'Gradient Purple',
                'pro' => false,
                'tokens' => [
                    'colors' => [
                        'primary' => '#7c3aed', 'secondary' => '#a855f7', 'accent' => '#ec4899',
                        'background' => '#f5f3ff', 'surface' => '#ffffff', 'text' => '#2e1065', 'border' => '#ddd6fe',
                    ],
                    'buttons' => ['style' => 'gradient', 'radius' => 20],
                    'background' => ['type' => 'gradient', 'value' => 'linear-gradient(135deg, #ede9fe, #fce7f3)'],
                ],
            ],
            [
                'slug' => 'neon',
                'name' => 'Neon',
                'pro' => true,
                'tokens' => [
                    'colors' => [
                        'primary' => '#39ff88', 'secondary' => '#00e5ff', 'accent' => '#ff2ee6',
                        'background' => '#05060a', 'surface' => '#0d1117', 'text' => '#e6f9ff', 'border' => '#193a2e',
                    ],
                    'buttons' => ['style' => 'outline', 'radius' => 10, 'shadow' => 'glow'],
                    'background' => ['type' => 'solid', 'value' => '#05060a'],
                    'animations' => ['hoverScale' => true, 'hoverLift' => false, 'fade' => true, 'slide' => true],
                ],
            ],
            [
                'slug' => 'ocean',
                'name' => 'Ocean',
                'pro' => false,
                'tokens' => [
                    'colors' => [
                        'primary' => '#0891b2', 'secondary' => '#0ea5e9', 'accent' => '#22d3ee',
                        'background' => '#ecfeff', 'surface' => '#ffffff', 'text' => '#083344', 'border' => '#a5f3fc',
                    ],
                    'background' => ['type' => 'gradient', 'value' => 'linear-gradient(160deg, #cffafe, #e0f2fe)'],
                ],
            ],
            [
                'slug' => 'forest',
                'name' => 'Forest',
                'pro' => false,
                'tokens' => [
                    'colors' => [
                        'primary' => '#15803d', 'secondary' => '#65a30d', 'accent' => '#ca8a04',
                        'background' => '#f0fdf4', 'surface' => '#ffffff', 'text' => '#14532d', 'border' => '#bbf7d0',
                    ],
                ],
            ],
            [
                'slug' => 'luxury-gold',
                'name' => 'Luxury Gold',
                'pro' => true,
                'tokens' => [
                    'colors' => [
                        'primary' => '#b8860b', 'secondary' => '#a16207', 'accent' => '#f5d78e',
                        'background' => '#1c1917', 'surface' => '#292524', 'text' => '#f5e9d3', 'border' => '#57534e',
                    ],
                    'buttons' => ['style' => 'gradient', 'radius' => 8],
                    'background' => ['type' => 'solid', 'value' => '#1c1917'],
                ],
            ],
            [
                'slug' => 'midnight',
                'name' => 'Midnight',
                'pro' => true,
                'tokens' => [
                    'colors' => [
                        'primary' => '#4f46e5', 'secondary' => '#312e81', 'accent' => '#6366f1',
                        'background' => '#020617', 'surface' => '#0f172a', 'text' => '#e2e8f0', 'border' => '#1e293b',
                    ],
                    'background' => ['type' => 'solid', 'value' => '#020617'],
                ],
            ],
            [
                'slug' => 'pastel',
                'name' => 'Pastel',
                'pro' => false,
                'tokens' => [
                    'colors' => [
                        'primary' => '#f9a8d4', 'secondary' => '#a5b4fc', 'accent' => '#fde68a',
                        'background' => '#fdf4ff', 'surface' => '#ffffff', 'text' => '#701a75', 'border' => '#f5d0fe',
                    ],
                    'buttons' => ['style' => 'filled', 'radius' => 24],
                ],
            ],
        ];
    }
}
