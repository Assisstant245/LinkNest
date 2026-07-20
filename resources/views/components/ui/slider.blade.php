@props([
    'label' => null,
    'value' => 50,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'unit' => 'px',
])

<div>
    @if($label)
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-600">{{ $label }}</span>
            <span class="text-xs text-gray-400 tabular-nums">{{ $value }}{{ $unit }}</span>
        </div>
    @endif
    <input
        type="range"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'w-full h-1.5 rounded-full appearance-none bg-gray-200 accent-indigo-500 cursor-pointer']) }}
    >
</div>
