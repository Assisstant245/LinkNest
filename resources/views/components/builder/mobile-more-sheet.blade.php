<div x-show="mobilePanel === 'more'" x-cloak @click="mobilePanel = null"
    class="fixed inset-0 bg-black/30 z-40 lg:hidden" x-transition.opacity></div>

<div
    x-show="mobilePanel === 'more'" x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full"
    class="fixed inset-x-0 bottom-0 z-50 lg:hidden bg-white rounded-t-2xl shadow-2xl pb-[env(safe-area-inset-bottom)]"
>
    <div class="flex items-center justify-between px-4 pt-4 pb-2">
        <span class="text-sm font-semibold text-gray-900">More</span>
        <button type="button" @click="mobilePanel = null" class="p-1 text-gray-400 hover:text-gray-600">
            <x-ui.icon name="close" class="w-4 h-4" />
        </button>
    </div>

    <div class="px-2 pb-2">
        <button type="button" wire:click="setLeftTab('theme')" @click="mobilePanel = 'elements'"
            class="w-full flex items-center gap-3 px-3 py-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
            <x-ui.icon name="swatch" class="w-4 h-4 text-gray-400" />
            Appearance
        </button>
        <button type="button" wire:click="deselectAll" @click="mobilePanel = 'properties'"
            class="w-full flex items-center gap-3 px-3 py-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
            <x-ui.icon name="contact" class="w-4 h-4 text-gray-400" />
            Profile
        </button>
    </div>
</div>
