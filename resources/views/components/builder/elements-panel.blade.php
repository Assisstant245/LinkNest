@props(['leftTab' => 'elements', 'theme' => [], 'themePresets' => [], 'activePresetSlug' => null, 'upgradeNotice' => null])

<aside class="w-72 shrink-0 border-r border-gray-200 bg-white flex flex-col h-full">
    <div class="px-4 pt-4 pb-3 border-b border-gray-100 shrink-0">
        <x-ui.segmented class="w-full [&>*]:flex-1">
            <x-ui.segment name="left-tab" value="elements" :active="$leftTab === 'elements'" wire:click="setLeftTab('elements')">Elements</x-ui.segment>
            <x-ui.segment name="left-tab" value="theme" :active="$leftTab === 'theme'" wire:click="setLeftTab('theme')">Theme</x-ui.segment>
        </x-ui.segmented>

        @if($leftTab === 'elements')
            <label class="relative mt-3 block">
                <x-ui.icon name="search" class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input
                    type="text"
                    placeholder="Search elements"
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-8 pr-3 py-2 text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"
                >
            </label>
        @else
            <p class="text-xs text-gray-400 mt-3">Pick a preset or customize your own design tokens</p>
        @endif
    </div>

    <div class="flex-1 overflow-y-auto px-4 py-4 space-y-6">
        @if($leftTab === 'elements')
            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Content</h3>
                <div class="grid grid-cols-2 gap-2.5" x-data x-init="initElementsSortable($el)">
                    <x-builder.element-card icon="heading" label="Heading" type="heading" />
                    <x-builder.element-card icon="text" label="Text" type="text" />
                    <x-builder.element-card icon="button" label="Button" type="button" />
                    <x-builder.element-card icon="social" label="Social Icons" type="social" />
                </div>
            </div>

            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Media</h3>
                <div class="grid grid-cols-2 gap-2.5" x-data x-init="initElementsSortable($el)">
                    <x-builder.element-card icon="image" label="Image" type="image" />
                    <x-builder.element-card icon="video" label="Video" type="video" />
                </div>
            </div>

            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Layout</h3>
                <div class="grid grid-cols-2 gap-2.5" x-data x-init="initElementsSortable($el)">
                    <x-builder.element-card icon="divider" label="Divider" type="divider" />
                    <x-builder.element-card icon="spacer" label="Spacer" type="spacer" />
                    <x-builder.element-card icon="contact" label="Contact" type="contact" />
                </div>
            </div>
        @else
            @if($upgradeNotice)
                <div class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2.5 text-xs text-amber-800">
                    {{ $upgradeNotice }}
                    <a href="{{ route('billing') }}" class="font-semibold underline">Upgrade</a>
                </div>
            @endif
            <x-theme.selector :presets="$themePresets" :active-preset-slug="$activePresetSlug" />
            <x-theme.customizer :theme="$theme" />
        @endif
    </div>

    @if($leftTab === 'elements')
        <div class="shrink-0 border-t border-gray-100 p-4">
            <div class="rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 p-4 text-white relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-white/10"></div>
                <p class="text-sm font-semibold">Unlock Pro blocks</p>
                <p class="text-xs text-white/80 mt-1 leading-relaxed">Get premium elements, analytics &amp; custom domains.</p>
                <button type="button" class="mt-3 text-xs font-semibold bg-white text-indigo-600 rounded-lg px-3 py-1.5 hover:bg-white/90 transition-colors">Upgrade</button>
            </div>
        </div>
    @endif
</aside>
