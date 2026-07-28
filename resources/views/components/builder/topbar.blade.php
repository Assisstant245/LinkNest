@props(['device' => 'mobile', 'lastSavedAt' => null, 'pageId' => null, 'userPages' => []])

<header class="h-16 shrink-0 grid grid-cols-3 items-center px-4 border-b border-gray-200 bg-white/95 backdrop-blur z-20">
    {{-- Left: brand + page title + history --}}
    <div class="flex items-center gap-3 min-w-0">
        <div class="flex items-center gap-2 shrink-0">
            <div
                class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-sm shadow-indigo-500/30">
                <svg viewBox="0 0 24 24" class="w-4.5 h-4.5 text-white" fill="currentColor">
                    <path
                        d="M9.5 14.5 14.5 9.5M8 17l-2 2a3.5 3.5 0 0 1-5-5l3-3a3.5 3.5 0 0 1 5-.2M16 7l2-2a3.5 3.5 0 0 1 5 5l-3 3a3.5 3.5 0 0 1-5 .2"
                        stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <span class="font-semibold text-gray-900 hidden lg:inline">LinkNest</span>
        </div>

        <span class="w-px h-6 bg-gray-200 hidden md:block shrink-0"></span>

        <div class="relative hidden md:block" x-data="{ open: false }">
            <button type="button" @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-1.5 min-w-0 text-sm font-medium text-gray-700 hover:text-gray-900 rounded-md px-2 py-1 hover:bg-gray-100 transition-colors">
                <span class="truncate max-w-[10rem]">
                    {{ collect($userPages)->firstWhere('id', $pageId)['profile_name'] ?? 'My Link Page' }}
                </span>
                <x-ui.icon name="chevron-down" class="w-3.5 h-3.5 text-gray-400 shrink-0" />
            </button>

            <div x-show="open" x-cloak class="absolute left-0 mt-2 w-56 rounded-lg border border-gray-200 bg-white shadow-lg py-1 z-30">
                @forelse($userPages as $page)
                    <button
                        type="button"
                        wire:click="switchPage({{ $page['id'] }})"
                        @class([
                            'w-full text-left px-3 py-2 text-sm truncate transition-colors',
                            'bg-indigo-50 text-indigo-600 font-medium' => $page['id'] === $pageId,
                            'text-gray-700 hover:bg-gray-50' => $page['id'] !== $pageId,
                        ])
                    >{{ $page['profile_name'] }}</button>
                @empty
                    <p class="px-3 py-2 text-xs text-gray-400">No pages yet</p>
                @endforelse
                <div class="border-t border-gray-100 mt-1 pt-1">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-50">Manage all pages</a>
                </div>
                <div class="border-t border-gray-100 mt-1 pt-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <a href="{{ route('templates') }}"
            class="hidden lg:flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 rounded-md px-2 py-1 hover:bg-gray-100 transition-colors">
            Templates
        </a>

        <a href="{{ route('analytics') }}"
            class="hidden lg:flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 rounded-md px-2 py-1 hover:bg-gray-100 transition-colors">
            Analytics
        </a>

        <span class="w-px h-6 bg-gray-200 hidden sm:block shrink-0"></span>

        <div class="flex items-center gap-0.5 shrink-0">
            <x-ui.button variant="ghost" size="icon" icon="undo" title="Undo" disabled />
            <x-ui.button variant="ghost" size="icon" icon="redo" title="Redo" />
        </div>
    </div>

    {{-- Center: device switcher --}}
    <div class="flex items-center justify-center">
        <x-ui.segmented>
            <x-ui.segment name="device" value="mobile" icon="mobile" :active="$device === 'mobile'" title="Mobile"
                wire:click="setDevice('mobile')" />
            <x-ui.segment name="device" value="tablet" icon="tablet" :active="$device === 'tablet'" title="Tablet"
                wire:click="setDevice('tablet')" />
            <x-ui.segment name="device" value="desktop" icon="desktop" :active="$device === 'desktop'" title="Desktop"
                wire:click="setDevice('desktop')" />
        </x-ui.segmented>
    </div>

    {{-- Right: actions --}}
    <div class="flex items-center justify-end gap-2">
        <span class="hidden xl:inline-flex items-center gap-1.5 text-xs text-gray-400 mr-1" wire:loading.remove
            wire:target="save">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            {{ $lastSavedAt ? "Saved {$lastSavedAt}" : 'Not saved yet' }}
        </span>
        <span class="hidden xl:inline-flex items-center gap-1.5 text-xs text-gray-400 mr-1" wire:loading
            wire:target="save">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
            Saving…
        </span>
        <x-ui.button variant="secondary" size="sm" icon="save" class="hidden sm:inline-flex" wire:click="save"
            wire:loading.attr="disabled" wire:target="save">
            <span wire:loading.remove wire:target="save">Save Draft</span>
            <span wire:loading wire:target="save">Saving…</span>
        </x-ui.button>
        <x-ui.button variant="secondary" size="sm" icon="eye">Preview</x-ui.button>
        <x-ui.button variant="primary" size="sm" icon="rocket" wire:click="publish">
            {{ $isPublished ? 'Republish' : 'Publish' }}
        </x-ui.button>

        @if ($publicUrl)
            <a href="{{ $publicUrl }}" target="_blank" class="text-xs text-indigo-600 hover:underline ml-2">
                {{ $publicUrl }}
            </a>
        @endif
    </div>
</header>
