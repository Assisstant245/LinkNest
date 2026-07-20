@props(['slug', 'name', 'tokens', 'active' => false, 'pro' => false])

@php
$locked = $pro && ! auth()->user()->isPro();
@endphp

<button
    type="button"
    wire:click="applyPreset('{{ $slug }}')"
    @class([
        'group relative flex flex-col gap-2.5 rounded-xl border bg-white px-3 py-3 text-left transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40',
        'border-indigo-500 ring-2 ring-indigo-500 ring-offset-2 ring-offset-white' => $active,
        'border-gray-200 hover:border-indigo-300' => !$active,
    ])
>
    <div class="flex items-center gap-1.5">
        <span class="w-4 h-4 rounded-full ring-1 ring-black/10" style="background: {{ $tokens['colors']['primary'] }}"></span>
        <span class="w-4 h-4 rounded-full ring-1 ring-black/10" style="background: {{ $tokens['colors']['secondary'] }}"></span>
        <span class="w-4 h-4 rounded-full ring-1 ring-black/10" style="background: {{ $tokens['colors']['accent'] }}"></span>
        <span class="w-4 h-4 rounded-full ring-1 ring-black/10" style="background: {{ $tokens['colors']['surface'] }}"></span>
    </div>

    <span class="flex items-center gap-1 text-xs font-semibold text-gray-800">
        {{ $name }}
        @if($locked)
            <x-ui.icon name="lock" class="w-3 h-3 text-amber-500" />
        @endif
    </span>

    @if($active)
        <span class="absolute top-2 right-2 w-4 h-4 rounded-full bg-indigo-500 text-white flex items-center justify-center">
            <x-ui.icon name="check" class="w-2.5 h-2.5" />
        </span>
    @endif
</button>
