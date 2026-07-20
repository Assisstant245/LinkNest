@props(['icon', 'label', 'type', 'badge' => null])

<div
    draggable="true"
    data-type="{{ $type }}"
    class="group relative flex flex-col items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-2 py-4 cursor-grab active:cursor-grabbing hover:border-indigo-300 hover:shadow-md hover:shadow-indigo-100 transition-all duration-150"
>
    <span class="absolute top-1.5 right-1.5 text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">
        <x-ui.icon name="grip" class="w-3.5 h-3.5" />
    </span>

    @if($badge)
        <span class="absolute top-1.5 left-1.5 text-[9px] font-semibold uppercase tracking-wide text-indigo-500 bg-indigo-50 rounded-full px-1.5 py-0.5">{{ $badge }}</span>
    @endif

    <div class="w-9 h-9 rounded-lg bg-gray-50 border border-gray-100 group-hover:bg-indigo-50 group-hover:border-indigo-100 flex items-center justify-center text-gray-500 group-hover:text-indigo-600 transition-colors">
        <x-ui.icon :name="$icon" class="w-4.5 h-4.5" />
    </div>
    <span class="text-xs font-medium text-gray-600 group-hover:text-gray-900">{{ $label }}</span>
</div>
