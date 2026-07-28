@props([
    'blocks' => [],
    'selectedBlockId' => null,
    'profileName' => '',
    'profileBio' => '',
    'photoUrl' => null,
    'coverUrl' => null,
    'theme' => [],
    'device' => 'mobile',
    'socialLinks' => [],
    'selectedSocialLinkId' => null,
    'availableSocialNetworks' => [],
])

<section class="relative flex-1 min-w-0 h-full overflow-hidden bg-gray-50">
    {{-- dotted backdrop --}}
    <div
        class="absolute inset-0 [background-image:radial-gradient(theme(colors.gray.300)_1px,transparent_1px)] [background-size:22px_22px] opacity-40">
    </div>

    <div class="relative h-full overflow-y-auto px-8 py-10">
        <x-builder.device-preview :device="$device" :theme="$theme">
            <div>
                <x-builder.profile-preview :name="$profileName" :bio="$profileBio" :photo-url="$photoUrl" :cover-url="$coverUrl" :social-links="$socialLinks" :selected-social-link-id="$selectedSocialLinkId"
                    :available-social-networks="$availableSocialNetworks" />

                @php
                    $hasProducts = collect($blocks)->contains(fn ($b) => $b['type'] === 'product');
                    $hasLinkBlocks = collect($blocks)->contains(fn ($b) => $b['type'] !== 'product');
                @endphp

                <div x-data="{ tab: 'links' }">
                    @if ($hasProducts)
                        <div class="mb-3" style="padding-left: var(--token-card-padding, 20px); padding-right: var(--token-card-padding, 20px);">
                            <div class="flex items-center gap-1 rounded-full bg-gray-100 p-1">
                                <button type="button" @click="tab = 'links'"
                                    :class="tab === 'links' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500'"
                                    class="flex-1 text-center text-xs font-semibold rounded-full py-1.5 transition-colors">
                                    Links
                                </button>
                                <button type="button" @click="tab = 'shop'"
                                    :class="tab === 'shop' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500'"
                                    class="flex-1 text-center text-xs font-semibold rounded-full py-1.5 transition-colors">
                                    Shop
                                </button>
                            </div>
                        </div>
                    @endif

                    <div x-init="initCanvasSortable($el, $wire)" wire:click.self="deselectAll"
                        class="pb-6 space-y-[var(--token-card-spacing,12px)]"
                        style="padding-left: var(--token-card-padding, 20px); padding-right: var(--token-card-padding, 20px); min-height: 96px;">
                        @forelse($blocks as $block)
                            @php
                                $blockTab = $block['type'] === 'product' ? 'shop' : 'links';
                                $blockShowExpr = $hasProducts ? "tab === '{$blockTab}'" : 'true';
                            @endphp
                            <x-builder.block :block="$block" :selected="$selectedBlockId === $block['id']"
                                x-show="{{ $blockShowExpr }}" x-cloak />
                        @empty
                            <div
                                class="text-center text-xs text-gray-400 py-10 border-2 border-dashed border-gray-200 rounded-xl">
                                Drag a block here to get started
                            </div>
                        @endforelse

                        @if ($hasProducts && !$hasLinkBlocks)
                            <div x-show="tab === 'links'" x-cloak
                                class="text-center text-xs text-gray-400 py-10 border-2 border-dashed border-gray-200 rounded-xl">
                                Drag a block here to get started
                            </div>
                        @endif
                    </div>
                </div>

                <div class="pb-8 flex justify-center">
                    <span
                        class="inline-flex items-center gap-1.5 text-[11px] font-medium text-gray-400 bg-white/70 border border-gray-100 rounded-full px-3 py-1.5">
                        <svg viewBox="0 0 24 24" class="w-3 h-3" fill="currentColor">
                            <path d="M12 2.5c3 1.5 5 4.8 5 9 0 2-1 4-1 4l-4 2-4-2s-1-2-1-4c0-4.2 2-7.5 5-9Z" />
                        </svg>
                        Made with LinkNest
                    </span>
                </div>
            </div>
        </x-builder.device-preview>
    </div>

    {{-- zoom / canvas controls --}}
    <div
        class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-1 bg-white border border-gray-200 rounded-full shadow-sm px-1.5 py-1.5">
        <x-ui.button variant="ghost" size="icon" title="Zoom out">
            <span class="text-base leading-none px-0.5">−</span>
        </x-ui.button>
        <span class="text-xs font-medium text-gray-500 px-1 tabular-nums">100%</span>
        <x-ui.button variant="ghost" size="icon" icon="plus" title="Zoom in" />
    </div>
</section>
