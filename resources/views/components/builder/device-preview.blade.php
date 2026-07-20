@props(['device' => 'mobile', 'theme' => []])

@php
$colors = $theme['colors'] ?? [];
$typography = $theme['typography'] ?? [];
$buttons = $theme['buttons'] ?? [];
$cards = $theme['cards'] ?? [];
$background = $theme['background'] ?? [];
$animations = $theme['animations'] ?? [];

$transformParts = [];
if ($animations['hoverScale'] ?? true) {
    $transformParts[] = 'scale(1.03)';
}
if ($animations['hoverLift'] ?? true) {
    $transformParts[] = 'translateY(-3px)';
}
if ($animations['slide'] ?? false) {
    $transformParts[] = 'translateX(2px)';
}

$shadowMap = [
    'none' => 'none',
    'soft' => '0 1px 3px rgba(0,0,0,0.08)',
    'strong' => '0 12px 28px rgba(0,0,0,0.18)',
    'glow' => '0 0 18px 2px var(--token-primary)',
];

$vars = [
    '--token-primary' => $colors['primary'] ?? '#6366f1',
    '--token-secondary' => $colors['secondary'] ?? '#8b5cf6',
    '--token-accent' => $colors['accent'] ?? '#ec4899',
    '--token-surface' => $colors['surface'] ?? '#ffffff',
    '--token-text' => $colors['text'] ?? '#111827',
    '--token-border' => $colors['border'] ?? '#e5e7eb',
    '--token-font' => "'" . ($typography['fontFamily'] ?? 'Instrument Sans') . "', sans-serif",
    '--token-font-size' => ($typography['fontSize'] ?? 15) . 'px',
    '--token-letter-spacing' => ($typography['letterSpacing'] ?? 0) . 'px',
    '--token-line-height' => (string) ($typography['lineHeight'] ?? 1.5),
    '--token-button-radius' => ($buttons['radius'] ?? 16) . 'px',
    '--token-button-height' => ($buttons['height'] ?? 48) . 'px',
    '--token-button-shadow' => $shadowMap[$buttons['shadow'] ?? 'soft'] ?? $shadowMap['soft'],
    '--token-button-width' => ($buttons['fullWidth'] ?? true) ? '100%' : '260px',
    '--token-card-radius' => ($cards['radius'] ?? 16) . 'px',
    '--token-card-padding' => ($cards['padding'] ?? 16) . 'px',
    '--token-card-spacing' => ($cards['spacing'] ?? 12) . 'px',
    '--token-card-shadow' => $shadowMap[$cards['shadow'] ?? 'soft'] ?? $shadowMap['soft'],
    '--token-page-bg' => $background['value'] ?? ($colors['background'] ?? '#f8fafc'),
    '--token-hover-transform' => $transformParts ? implode(' ', $transformParts) : 'none',
    '--token-hover-opacity' => ($animations['fade'] ?? true) ? '0.92' : '1',
];

$style = collect($vars)->map(fn ($value, $key) => "{$key}: {$value}")->implode('; ');

$backgroundImageUrl = ($background['type'] ?? null) === 'image'
    ? \App\Support\ImageProcessor::url($background['path'] ?? null)
    : null;

$pageBackgroundStyle = $backgroundImageUrl
    ? "background-image: url('{$backgroundImageUrl}'); background-size: cover; background-position: center;"
    : 'background: var(--token-page-bg)';
@endphp

<div style="{{ $style }}">
    @if($device === 'tablet')
        <div class="relative mx-auto w-[420px] transition-[width] duration-300 ease-out">
            <div class="rounded-[2rem] bg-gray-900 p-3.5 shadow-2xl shadow-gray-900/30 ring-1 ring-black/10">
                <div class="rounded-2xl overflow-hidden bg-white h-[640px] flex flex-col">
                    <div class="flex-1 overflow-y-auto" style="{{ $pageBackgroundStyle }}">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    @elseif($device === 'desktop')
        <div class="relative mx-auto w-[640px] transition-[width] duration-300 ease-out">
            <div class="rounded-xl bg-gray-900 p-2 shadow-2xl shadow-gray-900/30 ring-1 ring-black/10">
                <div class="flex items-center gap-1.5 px-2 pb-2 pt-0.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-green-400"></span>
                </div>
                <div class="rounded-lg overflow-hidden bg-white h-[560px] flex flex-col">
                    <div class="flex-1 overflow-y-auto" style="{{ $pageBackgroundStyle }}">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <x-builder.phone-frame :background-style="$pageBackgroundStyle">
            {{ $slot }}
        </x-builder.phone-frame>
    @endif
</div>
