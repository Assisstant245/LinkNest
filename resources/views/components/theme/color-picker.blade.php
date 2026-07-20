@props(['label', 'model', 'value'])

<label class="block">
    <p class="text-xs font-medium text-gray-600 mb-1.5">{{ $label }}</p>
    <div class="flex items-center gap-2 rounded-lg border border-gray-200 px-2.5 py-2 focus-within:ring-2 focus-within:ring-indigo-500/30 focus-within:border-indigo-300">
        <span class="w-4 h-4 rounded-full shrink-0 ring-1 ring-black/10" style="background: {{ $value }}"></span>
        <input type="text" wire:model.live="{{ $model }}" class="w-full text-xs font-medium text-gray-700 focus:outline-none bg-transparent">
    </div>
</label>
