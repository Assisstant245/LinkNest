@props([
    'variant' => 'secondary',
    'size' => 'md',
    'icon' => null,
])

@php
$variants = [
    'primary' => 'bg-gradient-to-b from-indigo-500 to-indigo-600 text-white shadow-sm shadow-indigo-500/30 hover:from-indigo-400 hover:to-indigo-600 border border-indigo-600/50',
    'secondary' => 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 shadow-sm',
    'ghost' => 'text-gray-500 hover:text-gray-900 hover:bg-gray-100 border border-transparent',
    'dark' => 'bg-gray-900 text-white hover:bg-gray-800 border border-gray-900',
];

$sizes = [
    'sm' => 'text-xs px-2.5 py-1.5 gap-1.5',
    'md' => 'text-sm px-3.5 py-2 gap-2',
    'icon' => 'p-2.5',
];

$base = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-150 whitespace-nowrap disabled:opacity-40 disabled:pointer-events-none';
@endphp

<button {{ $attributes->merge(['class' => "$base {$variants[$variant]} {$sizes[$size]}"]) }}>
    @if($icon)
        <x-ui.icon :name="$icon" class="w-4 h-4 shrink-0" />
    @endif
    {{ $slot }}
</button>
