@props(['model', 'value'])

@php
$fonts = ['Instrument Sans', 'Inter', 'Poppins', 'Playfair Display', 'Space Grotesk', 'Fraunces'];
@endphp

<label class="block">
    <p class="text-xs font-medium text-gray-600 mb-1.5">Font family</p>
    <div class="relative">
        <select wire:model.live="{{ $model }}" class="w-full appearance-none rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
            @foreach($fonts as $font)
                <option value="{{ $font }}" @selected($value === $font)>{{ $font }}</option>
            @endforeach
        </select>
        <x-ui.icon name="chevron-down" class="w-3.5 h-3.5 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
    </div>
</label>
