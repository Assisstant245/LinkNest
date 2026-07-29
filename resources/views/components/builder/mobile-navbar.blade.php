@props(['pageId' => null, 'userPages' => []])

<header class="h-16 lg:hidden shrink-0 flex items-center justify-between px-4 border-b border-gray-200 bg-white/95 backdrop-blur z-20">
    <div class="flex items-center gap-3 min-w-0">
        <div class="relative" x-data="{ open: false }">
            <button type="button" @click="open = !open" @click.outside="open = false"
                class="p-1.5 -ml-1 text-gray-600 hover:text-gray-900 rounded-md hover:bg-gray-100 shrink-0">
                <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div x-show="open" x-cloak @click.outside="open = false"
                class="absolute left-0 mt-2 w-56 rounded-xl border border-gray-200 bg-white shadow-xl py-2 z-50">

                {{-- Current page --}}
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-xs text-gray-500">Current Page</p>
                    <p class="font-semibold text-gray-900 truncate">
                        {{ collect($userPages)->firstWhere('id', $pageId)['profile_name'] ?? 'My Link Page' }}
                    </p>
                </div>

                {{-- Templates --}}
                <a href="{{ route('templates') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 3 9 5-9 5-9-5 9-5Z" /><path d="m3 13 9 5 9-5" />
                    </svg>
                    Templates
                </a>

                {{-- Analytics --}}
                <a href="{{ route('analytics') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                    <x-ui.icon name="desktop" class="w-4 h-4" />
                    Analytics
                </a>

                {{-- My Pages --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="3.5" /><path d="M5 20c0-3.3 3.1-6 7-6s7 2.7 7 6" />
                    </svg>
                    My Pages
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="M16 17l5-5-5-5" /><path d="M21 12H9" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

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
            <span class="font-semibold text-gray-900">LinkNest</span>
        </div>
    </div>

    <div class="flex items-center gap-2 shrink-0">
        <x-ui.button variant="secondary" size="sm" icon="save" wire:click="save"
            wire:loading.attr="disabled" wire:target="save" title="Save Draft" />
        <x-ui.button variant="secondary" size="sm" icon="eye" wire:click="preview"
            wire:loading.attr="disabled" wire:target="preview"
            x-on:open-preview.window="window.open($event.detail.url, '_blank')" title="Preview" />
        <x-ui.button variant="primary" size="sm" icon="rocket" wire:click="publish" title="Publish" />
    </div>
</header>
