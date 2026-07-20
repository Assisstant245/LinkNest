@props(['slug', 'name', 'category', 'description', 'previewColor', 'selected' => false, 'viewMode' => 'grid'])

<div @class([
    'group relative rounded-2xl border bg-white overflow-hidden transition-all duration-150 hover:-translate-y-1 hover:shadow-lg',
    'border-indigo-500 ring-2 ring-indigo-500 ring-offset-2 ring-offset-gray-50' => $selected,
    'border-gray-200' => !$selected,
    'flex' => $viewMode === 'list',
])>
    <div
        @class([
            'flex items-center justify-center shrink-0',
            'aspect-[9/16] w-full' => $viewMode === 'grid',
            'w-28 sm:w-36' => $viewMode === 'list',
        ])
        style="background: linear-gradient(160deg, {{ $previewColor }}22, {{ $previewColor }}55);"
    >
        <svg viewBox="0 0 24 24" class="w-10 h-10" style="color: {{ $previewColor }}" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="6" y="2.5" width="12" height="19" rx="2.5" />
            <path d="M10.5 19h3" stroke-linecap="round" />
        </svg>
    </div>

    <div class="p-4 flex-1 min-w-0 flex flex-col">
        <div class="flex items-center justify-between gap-2">
            <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $name }}</h3>
            <span class="shrink-0 text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full" style="background: {{ $previewColor }}1a; color: {{ $previewColor }};">
                {{ $category }}
            </span>
        </div>
        <p class="mt-1.5 text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $description }}</p>

        <div class="mt-3 pt-3 border-t border-gray-100 mt-auto flex items-center gap-2">
            <button
                type="button"
                wire:click="selectTemplate('{{ $slug }}')"
                class="flex-1 text-xs font-semibold rounded-lg border border-gray-200 text-gray-700 px-3 py-2 hover:border-indigo-300 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40"
            >
                Preview
            </button>
            <button
                type="button"
                wire:click="applyTemplate('{{ $slug }}')"
                wire:loading.attr="disabled"
                wire:target="applyTemplate('{{ $slug }}')"
                class="flex-1 text-xs font-semibold rounded-lg bg-indigo-600 text-white px-3 py-2 hover:bg-indigo-500 transition-colors disabled:opacity-60 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40"
            >
                <span wire:loading.remove wire:target="applyTemplate('{{ $slug }}')">Apply Template</span>
                <span wire:loading wire:target="applyTemplate('{{ $slug }}')">Applying…</span>
            </button>
        </div>
    </div>
</div>
