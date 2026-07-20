@props(['title', 'icon', 'open' => false])

<details @if($open) open @endif class="group border-b border-gray-100 last:border-0">
    <summary class="list-none [&::-webkit-details-marker]:hidden flex items-center justify-between px-4 py-3.5 cursor-pointer select-none hover:bg-gray-50 transition-colors">
        <span class="flex items-center gap-2.5">
            <span class="w-6 h-6 rounded-md bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-500 group-open:text-indigo-600 group-open:bg-indigo-50 group-open:border-indigo-100 transition-colors">
                <x-ui.icon :name="$icon" class="w-3.5 h-3.5" />
            </span>
            <span class="text-sm font-medium text-gray-800">{{ $title }}</span>
        </span>
        <x-ui.icon name="chevron-down" class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open:rotate-180" />
    </summary>

    <div class="px-4 pb-5 pt-1 space-y-4">
        {{ $slot }}
    </div>
</details>
