@props([
    'color' => '#6366f1',
    'selected' => false,
    'label' => null,
])

<button
    type="button"
    title="{{ $label ?? $color }}"
    {{ $attributes->merge(['class' => 'group relative w-7 h-7 rounded-full ring-1 ring-black/10 shrink-0 focus:outline-none']) }}
    style="background: {{ $color }}"
>
    @if($selected)
        <span class="absolute -inset-1 rounded-full ring-2 ring-indigo-500"></span>
    @endif
</button>
