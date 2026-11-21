@props(['leftTab' => 'link', 'blocks' => [], 'theme' => [], 'themePresets' => [], 'activePresetSlug' => null, 'upgradeNotice' => null, 'shopLogoUrl' => null])

<div x-show="mobilePanel === 'elements'" x-cloak @click="mobilePanel = null"
    class="fixed inset-0 bg-black/30 z-30 lg:hidden" x-transition.opacity></div>

<aside
    :class="mobilePanel === 'elements' ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-40 w-72 max-w-[85vw] shrink-0 border-r border-gray-200 bg-white flex flex-col h-full transition-transform duration-300 lg:static lg:z-auto lg:max-w-none lg:translate-x-0"
>
    <div class="px-4 pt-4 pb-3 border-b border-gray-100 shrink-0">
        <div class="flex items-center justify-between mb-1 lg:hidden">
            <span class="text-sm font-semibold text-gray-900">Elements</span>
            <button type="button" @click="mobilePanel = null" class="p-1 text-gray-400 hover:text-gray-600">
                <x-ui.icon name="close" class="w-4 h-4" />
            </button>
        </div>
        <x-ui.segmented class="w-full [&>*]:flex-1">
            <x-ui.segment name="left-tab" value="link" :active="$leftTab === 'link'" wire:click="setLeftTab('link')">Link</x-ui.segment>
            <x-ui.segment name="left-tab" value="shop" :active="$leftTab === 'shop'" wire:click="setLeftTab('shop')">Shop</x-ui.segment>
            <x-ui.segment name="left-tab" value="theme" :active="$leftTab === 'theme'" wire:click="setLeftTab('theme')">Theme</x-ui.segment>
        </x-ui.segmented>

        @if($leftTab === 'link')
            <label class="relative mt-3 block">
                <x-ui.icon name="search" class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input
                    type="text"
                    placeholder="Search elements"
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-8 pr-3 py-2 text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"
                >
            </label>
        @elseif($leftTab === 'shop')
            <p class="text-xs text-gray-400 mt-3">Add products people can buy — links out to your own store or payment page</p>
        @else
            <p class="text-xs text-gray-400 mt-3">Pick a preset or customize your own design tokens</p>
        @endif
    </div>

    <div class="flex-1 overflow-y-auto px-4 py-4 space-y-6">
        @if($leftTab === 'link')
            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Content</h3>
                <div class="grid grid-cols-2 gap-2.5" x-data x-init="initElementsSortable($el)">
                    <x-builder.element-card icon="heading" label="Heading" type="heading" :index="count($blocks)" />
                    <x-builder.element-card icon="text" label="Text" type="text" :index="count($blocks)" />
                    <x-builder.element-card icon="button" label="Button" type="button" :index="count($blocks)" />
                    <x-builder.element-card icon="social" label="Social Icons" type="social" :index="count($blocks)" />
                </div>
            </div>

            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Media</h3>
                <div class="grid grid-cols-2 gap-2.5" x-data x-init="initElementsSortable($el)">
                    <x-builder.element-card icon="image" label="Image" type="image" :index="count($blocks)" />
                    <x-builder.element-card icon="video" label="Video" type="video" :index="count($blocks)" />
                </div>
            </div>

            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Layout</h3>
                <div class="grid grid-cols-2 gap-2.5" x-data x-init="initElementsSortable($el)">
                    <x-builder.element-card icon="divider" label="Divider" type="divider" :index="count($blocks)" />
                    <x-builder.element-card icon="spacer" label="Spacer" type="spacer" :index="count($blocks)" />
                    <x-builder.element-card icon="contact" label="Contact" type="contact" :index="count($blocks)" />
                </div>
            </div>
        @elseif($leftTab === 'shop')
            @php $products = collect($blocks)->filter(fn ($b) => $b['type'] === 'product')->values(); @endphp
            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Shop logo</h3>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0 flex items-center justify-center">
                        @if ($shopLogoUrl)
                            <img src="{{ $shopLogoUrl }}" class="w-full h-full object-cover">
                        @else
                            <x-ui.icon name="image" class="w-4 h-4 text-gray-300" />
                        @endif
                    </div>
                    <div class="flex-1 flex items-center gap-2">
                        <label class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                            <span wire:loading.remove wire:target="shopLogoUpload">{{ $shopLogoUrl ? 'Replace' : 'Upload' }}</span>
                            <span wire:loading wire:target="shopLogoUpload">Uploading…</span>
                            <input type="file" wire:model="shopLogoUpload" accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                        </label>
                        @if ($shopLogoUrl)
                            <button type="button" wire:click="removeShopLogo"
                                class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                title="Remove">
                                <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                            </button>
                        @endif
                    </div>
                </div>
                @error('shopLogoUpload')
                    <p class="mt-1.5 text-[11px] text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1.5 text-[11px] text-gray-400">Shown above your products on the Shop tab</p>
            </div>

            <div>
                <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Products</h3>
                <div class="grid grid-cols-2 gap-2.5">
                    @foreach ($products as $product)
                        @php $thumb = \App\Support\ImageProcessor::url($product['data']['path'] ?? null); @endphp
                        <button type="button" wire:click="selectBlock('{{ $product['id'] }}')" wire:key="shop-product-{{ $product['id'] }}"
                            class="flex flex-col rounded-xl border border-gray-200 bg-white overflow-hidden hover:border-indigo-300 hover:shadow-sm transition-all text-left">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                                @if ($thumb)
                                    <img src="{{ $thumb }}" class="w-full h-full object-cover">
                                @else
                                    <x-ui.icon name="image" class="w-5 h-5 text-gray-300" />
                                @endif
                            </div>
                            <div class="p-2">
                                <p class="text-xs font-medium text-gray-800 truncate">{{ $product['data']['name'] ?? 'Product' }}</p>
                                <p class="text-[11px] text-gray-400">
                                    @if (($product['data']['price'] ?? null) !== null && $product['data']['price'] !== '')
                                        ${{ number_format((float) $product['data']['price'], 2) }}
                                    @else
                                        No price
                                    @endif
                                </p>
                            </div>
                        </button>
                    @endforeach

                    <button type="button" wire:click="addBlockAt('product', {{ count($blocks) }})"
                        class="flex flex-col items-center justify-center gap-1.5 aspect-square rounded-xl border-2 border-dashed border-gray-200 text-gray-400 hover:border-indigo-300 hover:text-indigo-500 transition-colors">
                        <x-ui.icon name="plus" class="w-5 h-5" />
                        <span class="text-[11px] font-medium">Add product</span>
                    </button>
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

    @if($leftTab === 'link' && ! auth()->user()->isPro())
        <div class="shrink-0 border-t border-gray-100 p-4">
            <div class="rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 p-4 text-white relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-white/10"></div>
                <p class="text-sm font-semibold">Unlock Pro blocks</p>
                <p class="text-xs text-white/80 mt-1 leading-relaxed">Get premium elements, analytics &amp; custom domains.</p>
                <a href="{{ route('billing') }}" class="mt-3 inline-block text-xs font-semibold bg-white text-indigo-600 rounded-lg px-3 py-1.5 hover:bg-white/90 transition-colors">Upgrade</a>
            </div>
        </div>
    @endif
</aside>
