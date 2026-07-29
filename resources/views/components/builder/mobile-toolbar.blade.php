<nav class="lg:hidden shrink-0 border-t border-gray-200 bg-white/95 backdrop-blur grid grid-cols-4 pb-[env(safe-area-inset-bottom)]">
    <button type="button" wire:click="setLeftTab('link')" @click="mobilePanel = 'elements'"
        class="flex flex-col items-center justify-center gap-1 py-2.5 text-gray-500 hover:text-indigo-600 transition-colors">
        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3.5" y="3.5" width="7" height="7" rx="1.5" /><rect x="13.5" y="3.5" width="7" height="7" rx="1.5" />
            <rect x="3.5" y="13.5" width="7" height="7" rx="1.5" /><rect x="13.5" y="13.5" width="7" height="7" rx="1.5" />
        </svg>
        <span class="text-[11px] font-medium">Blocks</span>
    </button>
    <button type="button" wire:click="setLeftTab('link')" @click="mobilePanel = 'elements'"
        class="flex flex-col items-center justify-center gap-1 py-2.5 text-gray-500 hover:text-indigo-600 transition-colors">
        <x-ui.icon name="plus" class="w-5 h-5" />
        <span class="text-[11px] font-medium">Add</span>
    </button>
    <button type="button" @click="mobilePanel = 'properties'"
        class="flex flex-col items-center justify-center gap-1 py-2.5 text-gray-500 hover:text-indigo-600 transition-colors">
        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
        </svg>
        <span class="text-[11px] font-medium">Edit</span>
    </button>
    <button type="button" @click="mobilePanel = 'more'"
        class="flex flex-col items-center justify-center gap-1 py-2.5 text-gray-500 hover:text-indigo-600 transition-colors">
        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor">
            <circle cx="5" cy="12" r="1.6" /><circle cx="12" cy="12" r="1.6" /><circle cx="19" cy="12" r="1.6" />
        </svg>
        <span class="text-[11px] font-medium">More</span>
    </button>
</nav>
