@php
$categories = [
    'all' => 'All', 'personal' => 'Personal', 'business' => 'Business',
    'creative' => 'Creative', 'education' => 'Education', 'ecommerce' => 'Ecommerce',
];
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Templates</h1>
            <p class="mt-1 text-sm text-gray-500">Start from a professionally designed layout and make it yours.</p>
        </div>

        <div class="flex items-center gap-1 rounded-lg bg-gray-100 p-1 shrink-0">
            <button
                type="button"
                wire:click="setViewMode('grid')"
                @class([
                    'flex items-center gap-1.5 rounded-md px-3 py-1.5 text-xs font-medium transition-colors',
                    'bg-white text-gray-900 shadow-sm' => $viewMode === 'grid',
                    'text-gray-500 hover:text-gray-800' => $viewMode !== 'grid',
                ])
            >
                <x-ui.icon name="button" class="w-3.5 h-3.5" />
                Grid
            </button>
            <button
                type="button"
                wire:click="setViewMode('list')"
                @class([
                    'flex items-center gap-1.5 rounded-md px-3 py-1.5 text-xs font-medium transition-colors',
                    'bg-white text-gray-900 shadow-sm' => $viewMode === 'list',
                    'text-gray-500 hover:text-gray-800' => $viewMode !== 'list',
                ])
            >
                <x-ui.icon name="text" class="w-3.5 h-3.5" />
                List
            </button>
        </div>
    </div>

    @if ($upgradeNotice)
        <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-3 py-2.5 text-xs text-amber-800">
            {{ $upgradeNotice }}
            <a href="{{ route('billing') }}" class="font-semibold underline">Upgrade</a>
        </div>
    @endif

    <div class="mt-6 flex flex-col md:flex-row md:items-center gap-3">
        <label class="relative flex-1 md:max-w-xs">
            <x-ui.icon name="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search templates"
                class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3 py-2 text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"
            >
        </label>

        <div class="flex items-center gap-2 flex-wrap">
            @foreach($categories as $value => $label)
                <button
                    type="button"
                    wire:click="setCategory('{{ $value }}')"
                    @class([
                        'text-xs font-medium rounded-full px-3 py-1.5 border transition-colors',
                        'border-indigo-500 bg-indigo-50 text-indigo-600' => $activeCategory === $value,
                        'border-gray-200 text-gray-600 hover:border-indigo-300' => $activeCategory !== $value,
                    ])
                >{{ $label }}</button>
            @endforeach
        </div>
    </div>

    <div wire:loading.class="opacity-50" wire:target="search, setCategory" class="mt-6 transition-opacity">
        @if($templates->isEmpty())
            <div class="text-center text-sm text-gray-400 py-16 border-2 border-dashed border-gray-200 rounded-2xl">
                No templates match your search.
            </div>
        @else
            <div @class([
                'grid gap-4',
                'grid-cols-2 sm:grid-cols-3 lg:grid-cols-4' => $viewMode === 'grid',
                'grid-cols-1' => $viewMode === 'list',
            ])>
                @foreach($templates as $template)
                    <x-templates.card
                        :slug="$template['slug']"
                        :name="$template['name']"
                        :category="$template['category']"
                        :description="$template['description']"
                        :preview-color="$template['previewColor']"
                        :selected="$selectedSlug === $template['slug']"
                        :view-mode="$viewMode"
                        :pro="$template['pro'] ?? false"
                        :locked="($template['pro'] ?? false) && ! $isPro"
                    />
                @endforeach
            </div>
        @endif
    </div>

    @if($selectedTemplate)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4" role="dialog" aria-modal="true">
            <div class="absolute inset-0 bg-gray-900/50" wire:click="closePreview"></div>

            <div class="relative w-full max-w-lg rounded-2xl bg-white shadow-2xl overflow-hidden">
                <button
                    type="button"
                    wire:click="closePreview"
                    class="absolute top-3 right-3 z-10 text-gray-400 hover:text-gray-700 rounded-md p-1 hover:bg-gray-100 transition-colors"
                >
                    <x-ui.icon name="close" class="w-4 h-4" />
                </button>

                <div class="h-40 flex items-center justify-center" style="background: linear-gradient(160deg, {{ $selectedTemplate['previewColor'] }}22, {{ $selectedTemplate['previewColor'] }}55);">
                    <svg viewBox="0 0 24 24" class="w-14 h-14" style="color: {{ $selectedTemplate['previewColor'] }}" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="6" y="2.5" width="12" height="19" rx="2.5" />
                        <path d="M10.5 19h3" stroke-linecap="round" />
                    </svg>
                </div>

                @php $selectedLocked = ($selectedTemplate['pro'] ?? false) && ! $isPro; @endphp
                <div class="p-6">
                    <div class="flex items-center justify-between gap-2">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-1.5">
                            {{ $selectedTemplate['name'] }}
                            @if ($selectedLocked)
                                <x-ui.icon name="lock" class="w-3.5 h-3.5 text-amber-500" />
                            @endif
                        </h2>
                        <span class="shrink-0 text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full" style="background: {{ $selectedTemplate['previewColor'] }}1a; color: {{ $selectedTemplate['previewColor'] }};">
                            {{ $selectedTemplate['category'] }}
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">{{ $selectedTemplate['description'] }}</p>

                    <div class="mt-5 flex items-center gap-2">
                        <button type="button" wire:click="closePreview" class="flex-1 text-sm font-medium rounded-lg border border-gray-200 text-gray-700 px-4 py-2.5 hover:border-gray-300 transition-colors">
                            Close
                        </button>
                        @if ($selectedLocked)
                            <a href="{{ route('billing') }}" class="flex-1 text-sm font-semibold rounded-lg bg-indigo-600 text-white px-4 py-2.5 hover:bg-indigo-500 transition-colors text-center">
                                Upgrade to Pro
                            </a>
                        @else
                            <button type="button" wire:click="applyTemplate('{{ $selectedTemplate['slug'] }}')" class="flex-1 text-sm font-semibold rounded-lg bg-indigo-600 text-white px-4 py-2.5 hover:bg-indigo-500 transition-colors">
                                Apply Template
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
