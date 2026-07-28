@props(['data' => []])

@php
    $imageUrl = \App\Support\ImageProcessor::url($data['path'] ?? null);
    $hasPrice = isset($data['price']) && $data['price'] !== null && $data['price'] !== '';
@endphp

<div class="overflow-hidden bg-white border"
    style="border-radius: var(--token-card-radius, 16px); border-color: var(--token-border, #e5e7eb); box-shadow: var(--token-card-shadow, none);">
    <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $data['name'] ?? 'Product' }}" class="w-full h-full object-cover">
        @else
            <x-ui.icon name="image" class="w-8 h-8 text-gray-300" />
        @endif
    </div>
    <div class="p-3">
        <p class="text-sm font-semibold truncate" style="color: var(--token-text, #111827);">
            {{ $data['name'] ?? 'Product' }}
        </p>
        @if (!empty($data['description']))
            <p class="mt-0.5 text-xs opacity-70 truncate" style="color: var(--token-text, #6b7280);">
                {{ $data['description'] }}
            </p>
        @endif
        <div class="mt-2 flex items-center justify-between gap-2">
            <span class="text-sm font-bold" style="color: var(--token-text, #111827);">
                @if ($hasPrice)
                    ${{ number_format((float) $data['price'], 2) }}
                @endif
            </span>
            <span class="shrink-0 text-xs font-semibold rounded-lg px-3 py-1.5" style="background: var(--token-primary, #6366f1); color: #fff;">
                Buy Now
            </span>
        </div>
    </div>
</div>
