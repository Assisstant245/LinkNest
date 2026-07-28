@props([
    'label' => 'Link title',
    'subtitle' => null,
    'icon' => null,
    'variant' => 'filled',
    'thumbnail' => false,
    'featured' => false,
])

@php
$styles = match ($variant) {
    'gradient' => 'background: linear-gradient(to right, var(--token-primary, #6366f1), var(--token-secondary, #8b5cf6)); color: #fff; border: 0;',
    'outline' => 'background: var(--token-surface, #fff); color: var(--token-text, #111827); border: 2px solid var(--token-text, #111827);',
    'soft' => 'background: var(--token-surface, #fff); color: var(--token-text, #111827); border: 1px solid var(--token-border, #e5e7eb);',
    default => 'background: var(--token-primary, #111827); color: #fff; border: 0;',
};

$featuredShadow = $featured
    ? ', 0 0 0 3px var(--token-primary, #6366f1), 0 10px 24px -8px var(--token-primary, #6366f1)'
    : '';
@endphp

<div
    class="relative flex items-center gap-3 mx-auto transition-transform duration-150 hover:-translate-y-0.5 cursor-pointer"
    style="{{ $styles }} width: var(--token-button-width, 100%); min-height: var(--token-button-height, 48px); border-radius: var(--token-button-radius, 16px); box-shadow: var(--token-button-shadow, none){{ $featuredShadow }}; padding-inline: 16px; font-family: var(--token-font, inherit);"
>
    @if($featured)
        <span
            class="absolute -top-2.5 -right-2 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full text-white shadow-sm whitespace-nowrap"
            style="background: var(--token-primary, #6366f1);"
        >★ Featured</span>
    @endif

    @if($thumbnail)
        <span class="w-8 h-8 rounded-lg bg-white/20 shrink-0 flex items-center justify-center overflow-hidden">
            <x-ui.icon name="image" class="w-4 h-4 opacity-70" />
        </span>
    @elseif($icon)
        <x-builder.link-icon :name="$icon" class="w-4.5 h-4.5 shrink-0" />
    @endif

    <span class="flex-1 min-w-0 text-center">
        <span class="block text-sm font-semibold truncate" style="font-size: var(--token-font-size, 15px);">{{ $label }}</span>
        @if($subtitle)
            <span class="block text-[11px] opacity-70 truncate">{{ $subtitle }}</span>
        @endif
    </span>

    @if($icon && !$thumbnail)
        <span class="w-4.5 shrink-0"></span>
    @endif
</div>
