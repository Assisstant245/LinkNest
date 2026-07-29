@props(['data' => []])

@php
    $imageUrl = \App\Support\ImageProcessor::url($data['path'] ?? null);
    $hasPrice = isset($data['price']) && $data['price'] !== null && $data['price'] !== '';

    $shadowMap = [
        'none' => 'none',
        'soft' => '0 1px 3px rgba(0,0,0,0.08)',
        'strong' => '0 12px 28px rgba(0,0,0,0.18)',
        'glow' => '0 0 18px 2px var(--token-primary, #6366f1)',
    ];

    $imgStyle = $data['style']['image'] ?? [];
    $imgRadius = $imgStyle['radius'] ?? null;
    $imgShadow = $shadowMap[$imgStyle['shadow'] ?? 'none'] ?? 'none';
    $imgAspectClass = ($imgStyle['aspect'] ?? 'square') === 'portrait' ? 'aspect-[3/4]' : 'aspect-square';

    $textStyle = $data['style']['text'] ?? [];
    $textColor = $textStyle['color'] ?? null;
    $textFont = $textStyle['fontFamily'] ?? null;
    $textSize = $textStyle['fontSize'] ?? null;
    $textWeightMap = ['regular' => 400, 'medium' => 500, 'bold' => 700];
    $textWeight = $textWeightMap[$textStyle['fontWeight'] ?? 'medium'] ?? 500;

    $btnStyle = $data['style']['button'] ?? [];
    $btnBg = $btnStyle['bg'] ?? null;
    $btnText = $btnStyle['textColor'] ?? '#ffffff';
    $btnRadius = $btnStyle['radius'] ?? 8;
@endphp

<div class="w-full overflow-hidden bg-white border"
    style="border-radius: var(--token-card-radius, 16px); border-color: var(--token-border, #e5e7eb); box-shadow: var(--token-card-shadow, none);">
    <div class="{{ $imgAspectClass }} bg-gray-50 flex items-center justify-center overflow-hidden"
        style="{{ $imgRadius !== null ? "border-radius: {$imgRadius}px;" : '' }} box-shadow: {{ $imgShadow }};">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $data['name'] ?? 'Product' }}" class="w-full h-full object-cover">
        @else
            <x-ui.icon name="image" class="w-8 h-8 text-gray-300" />
        @endif
    </div>
    <div class="p-3"
        style="color: {{ $textColor ?? 'var(--token-text, #111827)' }}; {{ $textFont ? "font-family: '{$textFont}', sans-serif;" : '' }} font-size: {{ $textSize ?? 14 }}px; font-weight: {{ $textWeight }};">
        <p class="truncate">
            {{ $data['name'] ?? 'Product' }}
        </p>
        @if (!empty($data['description']))
            <p class="mt-0.5 truncate opacity-70" style="font-size: 0.85em; font-weight: 400;">
                {{ $data['description'] }}
            </p>
        @endif
        <div class="mt-2 flex items-center justify-between gap-2">
            <span style="font-weight: 700;">
                @if ($hasPrice)
                    ${{ number_format((float) $data['price'], 2) }}
                @endif
            </span>
            <span class="shrink-0 text-xs px-3 py-1.5"
                style="background: {{ $btnBg ?? 'var(--token-primary, #6366f1)' }}; color: {{ $btnText }}; border-radius: {{ $btnRadius }}px; font-weight: 600;">
                Buy Now
            </span>
        </div>
    </div>
</div>
