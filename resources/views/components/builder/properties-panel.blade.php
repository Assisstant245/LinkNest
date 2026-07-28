@props([
    'selectedBlock' => null,
    'selectedIndex' => null,
    'profileName' => '',
    'profileBio' => '',
    'photoUrl' => null,
    'profilePhotoProcessing' => false,
    'coverPhotoUrl' => null,
    'theme' => [],
    'iconSearch' => '',
    'filteredIcons' => [],
    'selectedSocialLink' => null,
    'selectedSocialIndex' => null,
])

@php
    $typeLabels = [
        'heading' => 'Heading',
        'text' => 'Text',
        'button' => 'Button',
        'social' => 'Social Icons',
        'divider' => 'Divider',
        'spacer' => 'Spacer',
        'image' => 'Image',
        'video' => 'Video',
        'contact' => 'Contact',
        'product' => 'Product',
    ];
    $typeIcons = [
        'heading' => 'heading',
        'text' => 'text',
        'button' => 'button',
        'social' => 'social',
        'divider' => 'divider',
        'spacer' => 'spacer',
        'image' => 'image',
        'video' => 'video',
        'contact' => 'contact',
        'product' => 'lucide:shopping-bag',
    ];
    $socialNetworks = config('builder.social_networks', []);
@endphp

<aside class="w-80 shrink-0 border-l border-gray-200 bg-white flex flex-col h-full">
    {{-- Header --}}
    <div class="px-4 pt-4 pb-3 border-b border-gray-100 shrink-0">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-900">
                {{ $selectedBlock ? 'Properties' : ($selectedSocialLink ? 'Social Link' : 'Profile') }}
            </h2>
            @if ($selectedBlock)
                <button type="button" wire:click="deselectBlock"
                    class="text-gray-400 hover:text-gray-700 rounded-md p-1 hover:bg-gray-100 transition-colors"
                    title="Deselect">
                    <x-ui.icon name="close" class="w-4 h-4" />
                </button>
            @elseif($selectedSocialLink)
                <button type="button" wire:click="deselectSocialLink"
                    class="text-gray-400 hover:text-gray-700 rounded-md p-1 hover:bg-gray-100 transition-colors"
                    title="Deselect">
                    <x-ui.icon name="close" class="w-4 h-4" />
                </button>
            @endif
        </div>

        @if ($selectedBlock)
            <div class="mt-3 flex items-center gap-2.5 rounded-lg bg-indigo-50/70 border border-indigo-100 px-3 py-2.5">
                <span
                    class="w-7 h-7 rounded-md bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white shrink-0">
                    <x-builder.link-icon :name="$typeIcons[$selectedBlock['type']] ?? 'button'" class="w-3.5 h-3.5" />
                </span>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-900 truncate">
                        {{ $typeLabels[$selectedBlock['type']] ?? 'Block' }}</p>
                    <p class="text-[11px] text-gray-500">{{ $typeLabels[$selectedBlock['type']] ?? 'Block' }} block</p>
                </div>
            </div>
        @elseif($selectedSocialLink)
            <div class="mt-3 flex items-center gap-2.5 rounded-lg bg-indigo-50/70 border border-indigo-100 px-3 py-2.5">
                <span
                    class="w-7 h-7 rounded-md bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white shrink-0">
                    <x-ui.icon :name="$selectedSocialLink['network']" class="w-3.5 h-3.5" />
                </span>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-900 truncate capitalize">
                        {{ str_replace('-', ' ', $selectedSocialLink['network']) }}</p>
                    <p class="text-[11px] text-gray-500">Social link</p>
                </div>
            </div>
        @endif
    </div>

    {{-- Accordion sections --}}
    <div class="flex-1 overflow-y-auto">
        @if ($selectedBlock)
            <x-builder.property-section title="Content" icon="typography" :open="true">
                <div wire:key="props-content-{{ $selectedBlock['id'] }}">
                    @switch($selectedBlock['type'])
                        @case('heading')
                        @case('text')
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Text</p>
                                <textarea wire:model.live="blocks.{{ $selectedIndex }}.data.text" rows="3"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"></textarea>
                            </label>
                        @break

                        @case('button')
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Label</p>
                                <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.label"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            </label>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">URL</p>
                                <div class="flex items-center gap-2">
                                    <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.url"
                                        placeholder="https://"
                                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                                    @if (!empty($selectedBlock['data']['url']))
                                        <a href="{{ $selectedBlock['data']['url'] }}" target="_blank" rel="noopener noreferrer"
                                            onclick="event.stopPropagation()" title="Open link in new tab"
                                            class="shrink-0 w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:text-indigo-600 hover:border-indigo-300 transition-colors">
                                            <x-ui.icon name="link" class="w-3.5 h-3.5" />
                                        </a>
                                    @endif
                                </div>
                            </label>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Subtitle</p>
                                <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.subtitle"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            </label>
                            <div>
                                <p class="text-xs font-medium text-gray-600 mb-2">Style</p>
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach (['filled' => 'Filled', 'gradient' => 'Gradient', 'outline' => 'Outline', 'soft' => 'Soft'] as $value => $variantLabel)
                                        <button type="button"
                                            wire:click="$set('blocks.{{ $selectedIndex }}.data.variant', '{{ $value }}')"
                                            @class([
                                                'text-[11px] font-medium rounded-lg border px-2 py-1.5 transition-colors',
                                                'border-indigo-500 bg-indigo-50 text-indigo-600' =>
                                                    ($selectedBlock['data']['variant'] ?? 'filled') === $value,
                                                'border-gray-200 text-gray-600 hover:border-indigo-300' =>
                                                    ($selectedBlock['data']['variant'] ?? 'filled') !== $value,
                                            ])>{{ $variantLabel }}</button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="relative" x-data="{ open: false }">
                                <p class="text-xs font-medium text-gray-600 mb-2">Icon</p>
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="open = !open" @click.outside="open = false"
                                        class="w-9 h-9 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-indigo-300 transition-colors shrink-0">
                                        @if (!empty($selectedBlock['data']['icon']))
                                            <x-builder.link-icon :name="$selectedBlock['data']['icon']" class="w-4 h-4" />
                                        @else
                                            <x-ui.icon name="close" class="w-3.5 h-3.5 text-gray-300" />
                                        @endif
                                    </button>
                                    <span class="text-[11px] text-gray-400">
                                        {{ !empty($selectedBlock['data']['icon']) ? 'Click to change' : 'No icon selected' }}
                                    </span>
                                </div>

                                <div x-show="open" x-cloak x-transition @click.stop
                                    class="absolute z-20 top-full mt-2 left-0 w-64 bg-white border border-gray-200 rounded-xl shadow-lg p-3 space-y-2.5">
                                    <input type="text" wire:model.live.debounce.300ms="iconSearch"
                                        placeholder="Search icons…"
                                        class="w-full rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">

                                    <div class="max-h-48 overflow-y-auto grid grid-cols-6 gap-1.5">
                                        <button type="button"
                                            wire:click="setBlockIcon('{{ $selectedBlock['id'] }}', null)"
                                            @click="open = false" title="None"
                                            @class([
                                                'w-8 h-8 rounded-lg flex items-center justify-center border transition-colors',
                                                'border-indigo-500 bg-indigo-50 text-indigo-600' =>
                                                    empty($selectedBlock['data']['icon']),
                                                'border-gray-200 text-gray-400 hover:border-indigo-300' =>
                                                    !empty($selectedBlock['data']['icon']),
                                            ])>
                                            <x-ui.icon name="close" class="w-3.5 h-3.5" />
                                        </button>
                                        @forelse ($filteredIcons as $iconValue)
                                            <button type="button"
                                                wire:click="setBlockIcon('{{ $selectedBlock['id'] }}', '{{ $iconValue }}')"
                                                @click="open = false"
                                                title="{{ str_replace('-', ' ', ucfirst(str($iconValue)->after('lucide:'))) }}"
                                                @class([
                                                    'w-8 h-8 rounded-lg flex items-center justify-center border transition-colors',
                                                    'border-indigo-500 bg-indigo-50 text-indigo-600' =>
                                                        ($selectedBlock['data']['icon'] ?? null) === $iconValue,
                                                    'border-gray-200 text-gray-400 hover:border-indigo-300' =>
                                                        ($selectedBlock['data']['icon'] ?? null) !== $iconValue,
                                                ])>
                                                <x-builder.link-icon :name="$iconValue" class="w-4 h-4" />
                                            </button>
                                        @empty
                                            <p class="col-span-6 text-[11px] text-gray-400 text-center py-2">No icons found.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <label class="flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-600">Featured</span>
                                <input type="checkbox" wire:model.live="blocks.{{ $selectedIndex }}.data.featured"
                                    class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/40">
                            </label>
                        @break

                        @case('video')
                            @php $blockVideoUrl = \App\Support\VideoProcessor::url($selectedBlock['data']['path'] ?? null); @endphp
                            <div class="space-y-2">
                                @if ($blockVideoUrl)
                                    <video controls class="w-full h-32 rounded-lg border border-gray-200"
                                        src="{{ $blockVideoUrl }}"></video>
                                @endif
                                <div class="flex items-center gap-2">
                                    <label
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                                        <span wire:loading.remove
                                            wire:target="blockVideoUpload">{{ $blockVideoUrl ? 'Replace video' : 'Upload video' }}</span>
                                        <span wire:loading wire:target="blockVideoUpload">Uploading…</span>
                                        <input type="file" wire:model="blockVideoUpload"
                                            accept="video/mp4,video/webm,video/ogg,video/quicktime" class="hidden">
                                    </label>
                                    @if ($blockVideoUrl)
                                        <button type="button" wire:click="removeBlockVideo('{{ $selectedBlock['id'] }}')"
                                            class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                            title="Remove">
                                            <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                        </button>
                                    @endif
                                </div>
                                <p class="text-[11px] text-gray-400">MP4, MOV, WebM, or Ogg — up to 40MB.</p>
                                @error('blockVideoUpload')
                                    <p class="text-[11px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Or paste a video URL</p>
                                <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.url"
                                    placeholder="https://youtube.com/watch?v=…"
                                    @disabled($blockVideoUrl)
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                <p class="mt-1.5 text-[11px] text-gray-400">YouTube, Vimeo, or a direct video file link.</p>
                            </label>
                        @break

                        @case('contact')
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600">Email</p>
                                <input type="email" wire:model.live="blocks.{{ $selectedIndex }}.data.email"
                                    placeholder="you@example.com"
                                    class="w-full rounded-lg border border-gray-200 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            </label>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 ">Phone</p>
                                <input type="tel" wire:model.live="blocks.{{ $selectedIndex }}.data.phone"
                                    placeholder="+1 555 123 4567"
                                    class="w-full rounded-lg border border-gray-200 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            </label>
                        @break

                        @case('product')
                            @php $productImageUrl = \App\Support\ImageProcessor::url($selectedBlock['data']['path'] ?? null); @endphp
                            <div class="space-y-2">
                                @if ($productImageUrl)
                                    <img src="{{ $productImageUrl }}"
                                        class="w-full h-32 rounded-lg object-cover border border-gray-200">
                                @endif
                                <div class="flex items-center gap-2">
                                    <label
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                                        <span wire:loading.remove
                                            wire:target="productImageUpload">{{ $productImageUrl ? 'Replace' : 'Upload image' }}</span>
                                        <span wire:loading wire:target="productImageUpload">Uploading…</span>
                                        <input type="file" wire:model="productImageUpload"
                                            accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                                    </label>
                                    @if ($productImageUrl)
                                        <button type="button" wire:click="removeProductImage('{{ $selectedBlock['id'] }}')"
                                            class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                            title="Remove">
                                            <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                        </button>
                                    @endif
                                </div>
                                @error('productImageUpload')
                                    <p class="text-[11px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Product name</p>
                                <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.name"
                                    placeholder="Digital Planner"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            </label>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Description</p>
                                <textarea wire:model.live="blocks.{{ $selectedIndex }}.data.description" rows="2"
                                    placeholder="Stay organized and productive"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"></textarea>
                            </label>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Price</p>
                                <div class="flex items-center rounded-lg border border-gray-200 px-3 focus-within:ring-2 focus-within:ring-indigo-500/30 focus-within:border-indigo-300">
                                    <span class="text-xs font-medium text-gray-400">$</span>
                                    <input type="number" step="0.01" min="0" wire:model.live="blocks.{{ $selectedIndex }}.data.price"
                                        placeholder="12.99"
                                        class="w-full border-0 bg-transparent px-1.5 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-0">
                                </div>
                            </label>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Buy link</p>
                                <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.url"
                                    placeholder="https://your-store.com/product"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                                <p class="mt-1.5 text-[11px] text-gray-400">Where "Buy Now" sends visitors — your store, payment link, etc.</p>
                            </label>
                        @break

                        @case('image')
                            @php $blockImageUrl = \App\Support\ImageProcessor::url($selectedBlock['data']['path'] ?? null); @endphp
                            <div class="space-y-2">
                                @if ($blockImageUrl)
                                    <img src="{{ $blockImageUrl }}"
                                        class="w-full h-32 rounded-lg object-cover border border-gray-200">
                                @endif
                                <div class="flex items-center gap-2">
                                    <label
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                                        <span wire:loading.remove
                                            wire:target="blockImageUpload">{{ $blockImageUrl ? 'Replace' : 'Upload image' }}</span>
                                        <span wire:loading wire:target="blockImageUpload">Uploading…</span>
                                        <input type="file" wire:model="blockImageUpload"
                                            accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                                    </label>
                                    @if ($blockImageUrl)
                                        <button type="button" wire:click="removeBlockImage('{{ $selectedBlock['id'] }}')"
                                            class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                            title="Remove">
                                            <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                        </button>
                                    @endif
                                </div>
                                @error('blockImageUpload')
                                    <p class="text-[11px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <label class="block">
                                <p class="text-xs font-medium text-gray-600 mb-1.5">Alt text</p>
                                <input type="text" wire:model.live="blocks.{{ $selectedIndex }}.data.alt"
                                    placeholder="Describe this image"
                                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            </label>
                        @break

                        @case('social')
                            <div>
                                <p class="text-xs font-medium text-gray-600 mb-2">Networks</p>
                                <div class="flex flex-wrap gap-2">
     
                                    @foreach ($socialNetworks as $network)
                                        <button type="button"
                                            wire:click="toggleSocialNetwork('{{ $selectedBlock['id'] }}', '{{ $network }}')"
                                            @class([
                                                'w-8 h-8 rounded-full flex items-center justify-center border transition-colors',
                                                'border-indigo-500 bg-indigo-50 text-indigo-600' => in_array(
                                                    $network,
                                                    $selectedBlock['data']['networks'] ?? []),
                                                'border-gray-200 text-gray-400 hover:border-indigo-300' => !in_array(
                                                    $network,
                                                    $selectedBlock['data']['networks'] ?? []),
                                            ])>
                                            <x-ui.icon :name="$network" class="w-4 h-4" />
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @break

                        @case('spacer')
                            <x-ui.slider label="Height" unit="px" :min="0" :max="120" :value="$selectedBlock['data']['height'] ?? 24"
                                wire:model.live="blocks.{{ $selectedIndex }}.data.height" />
                        @break

                        @case('divider')
                            <p class="text-xs text-gray-400">Dividers have no content settings.</p>
                        @break

                        @default
                            <p class="text-xs text-gray-400">{{ $typeLabels[$selectedBlock['type']] ?? 'This block' }} settings
                                are coming soon.</p>
                    @endswitch
                </div>
            </x-builder.property-section>

            @php
                $style = $selectedBlock['data']['style'] ?? [];
                $textColor = $style['textColor'] ?? '#111827';
                $fontFamily = $style['fontFamily'] ?? 'Instrument Sans';
                $fontSize = $style['fontSize'] ?? 15;
                $fontWeight = $style['fontWeight'] ?? 'medium';
                $align = $style['align'] ?? 'center';
                $paddingV = $style['paddingV'] ?? 14;
                $paddingH = $style['paddingH'] ?? 20;
                $gap = $style['gap'] ?? 12;
                $margin = $style['margin'] ?? 0;
                $radius = $style['radius'] ?? 16;
                $shadow = $style['shadow'] ?? 'soft';
                $bgType = $style['background']['type'] ?? 'solid';
                $bgValue = $style['background']['value'] ?? null;
            @endphp

            <x-builder.property-section title="Colors" icon="swatch">
                <div>
                    <p class="text-xs font-medium text-gray-600 mb-2">Text color</p>
                    <div class="flex items-center gap-2 flex-wrap">
                        @foreach (['#111827', '#ffffff', '#6366f1', '#ec4899', '#10b981'] as $color)
                            <x-ui.color-swatch :color="$color" :selected="$textColor === $color"
                                wire:click="$set('blocks.{{ $selectedIndex }}.data.style.textColor', '{{ $color }}')" />
                        @endforeach
                    </div>
                </div>

                <label class="block">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">Custom color</p>
                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 px-2.5 py-2">
                        <input type="color" value="{{ $textColor }}"
                            wire:model.live="blocks.{{ $selectedIndex }}.data.style.textColor"
                            class="w-6 h-6 rounded-full border-0 shrink-0 cursor-pointer">
                        <span class="w-full text-xs font-medium text-gray-700 uppercase">{{ $textColor }}</span>
                    </div>
                </label>
            </x-builder.property-section>

            <x-builder.property-section title="Typography" icon="typography">
                <label class="block">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">Font family</p>
                    <div class="relative">
                        <select wire:model.live="blocks.{{ $selectedIndex }}.data.style.fontFamily"
                            class="w-full appearance-none rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                            @foreach (['Instrument Sans', 'Inter', 'Poppins', 'Playfair Display'] as $font)
                                <option value="{{ $font }}" @selected($fontFamily === $font)>{{ $font }}</option>
                            @endforeach
                        </select>
                        <x-ui.icon name="chevron-down"
                            class="w-3.5 h-3.5 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                    </div>
                </label>

                <x-ui.slider label="Font size" :value="$fontSize" unit="px" :min="10" :max="32"
                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.fontSize" />

                <div>
                    <p class="text-xs font-medium text-gray-600 mb-2">Weight</p>
                    <x-ui.segmented class="w-full [&>*]:flex-1">
                        @foreach (['regular' => 'Regular', 'medium' => 'Medium', 'bold' => 'Bold'] as $val => $label)
                            <x-ui.segment name="weight" :value="$val" :active="$fontWeight === $val"
                                wire:click="$set('blocks.{{ $selectedIndex }}.data.style.fontWeight', '{{ $val }}')">
                                {{ $label }}
                            </x-ui.segment>
                        @endforeach
                    </x-ui.segmented>
                </div>

                <div class="flex items-center justify-between">
                    <x-ui.segmented>
                        <x-ui.segment type="checkbox" name="style-bold" icon="bold" title="Bold"
                            :active="$style['bold'] ?? false"
                            wire:click="$set('blocks.{{ $selectedIndex }}.data.style.bold', {{ ($style['bold'] ?? false) ? 'false' : 'true' }})" />
                        <x-ui.segment type="checkbox" name="style-italic" icon="italic" title="Italic"
                            :active="$style['italic'] ?? false"
                            wire:click="$set('blocks.{{ $selectedIndex }}.data.style.italic', {{ ($style['italic'] ?? false) ? 'false' : 'true' }})" />
                        <x-ui.segment type="checkbox" name="style-underline" icon="underline" title="Underline"
                            :active="$style['underline'] ?? false"
                            wire:click="$set('blocks.{{ $selectedIndex }}.data.style.underline', {{ ($style['underline'] ?? false) ? 'false' : 'true' }})" />
                    </x-ui.segmented>
                    <x-ui.segmented>
                        @foreach (['left' => 'align-left', 'center' => 'align-center', 'right' => 'align-right'] as $val => $icon)
                            <x-ui.segment name="align" :value="$val" :icon="$icon" :active="$align === $val"
                                title="Align {{ $val }}"
                                wire:click="$set('blocks.{{ $selectedIndex }}.data.style.align', '{{ $val }}')" />
                        @endforeach
                    </x-ui.segmented>
                </div>
            </x-builder.property-section>

            <x-builder.property-section title="Spacing" icon="spacing">
                <x-ui.slider label="Padding (vertical)" :value="$paddingV" unit="px" :max="48"
                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.paddingV" />
                <x-ui.slider label="Padding (horizontal)" :value="$paddingH" unit="px" :max="48"
                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.paddingH" />
                <x-ui.slider label="Gap below block" :value="$gap" unit="px" :max="40"
                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.gap" />
                <x-ui.slider label="Outer margin" :value="$margin" unit="px" :max="40"
                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.margin" />
            </x-builder.property-section>

            <x-builder.property-section title="Border Radius" icon="radius">
                <div class="grid grid-cols-5 gap-2">
                    @foreach ([['None', 'rounded-none', 0], ['Sm', 'rounded-md', 8], ['Md', 'rounded-xl', 16], ['Lg', 'rounded-2xl', 24], ['Full', 'rounded-full', 9999]] as [$label, $rounded, $px])
                        <button type="button" class="flex flex-col items-center gap-1.5 group"
                            wire:click="$set('blocks.{{ $selectedIndex }}.data.style.radius', {{ $px }})">
                            <span @class([
                                'w-full h-9 border-2 bg-gray-50 transition-colors',
                                $rounded,
                                'border-indigo-500 bg-indigo-50' => $radius === $px,
                                'border-gray-200 group-hover:border-indigo-300' => $radius !== $px,
                            ])></span>
                            <span @class([
                                'text-[10px] font-medium',
                                'text-indigo-600' => $radius === $px,
                                'text-gray-500' => $radius !== $px,
                            ])>{{ $label }}</span>
                        </button>
                    @endforeach
                </div>
                <x-ui.slider label="Custom radius" :value="$radius" unit="px" :max="48"
                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.radius" />
            </x-builder.property-section>

            <x-builder.property-section title="Shadows" icon="shadow">
                <div class="grid grid-cols-4 gap-3">
                    @foreach ([['None', 'shadow-none', 'none'], ['Soft', 'shadow-md', 'soft'], ['Strong', 'shadow-xl', 'strong'], ['Glow', 'shadow-lg shadow-indigo-300', 'glow']] as [$label, $previewClass, $val])
                        <button type="button" class="flex flex-col items-center gap-1.5 group"
                            wire:click="$set('blocks.{{ $selectedIndex }}.data.style.shadow', '{{ $val }}')">
                            <span @class([
                                'w-full h-9 rounded-lg bg-white border transition-shadow',
                                $previewClass,
                                'border-indigo-400 ring-2 ring-indigo-100' => $shadow === $val,
                                'border-gray-200' => $shadow !== $val,
                            ])></span>
                            <span @class([
                                'text-[10px] font-medium',
                                'text-indigo-600' => $shadow === $val,
                                'text-gray-500' => $shadow !== $val,
                            ])>{{ $label }}</span>
                        </button>
                    @endforeach
                </div>
            </x-builder.property-section>

            <x-builder.property-section title="Background" icon="background">
                <x-ui.segmented class="w-full [&>*]:flex-1">
                    <x-ui.segment name="bg-type" value="solid" :active="$bgType === 'solid'"
                        wire:click="$set('blocks.{{ $selectedIndex }}.data.style.background.type', 'solid')">Solid</x-ui.segment>
                    <x-ui.segment name="bg-type" value="gradient" :active="$bgType === 'gradient'"
                        wire:click="$set('blocks.{{ $selectedIndex }}.data.style.background.type', 'gradient')">Gradient</x-ui.segment>
                    <x-ui.segment name="bg-type" value="image" :active="$bgType === 'image'"
                        wire:click="$set('blocks.{{ $selectedIndex }}.data.style.background.type', 'image')">Image</x-ui.segment>
                </x-ui.segmented>

                @if ($bgType === 'image')
                    <x-builder.blocks.placeholder icon="image" label="Per-block image backgrounds — coming soon" />
                @else
                    <label class="block">
                        <p class="text-xs font-medium text-gray-600 mb-1.5">{{ $bgType === 'gradient' ? 'Gradient CSS' : 'Color' }}</p>
                        @if ($bgType === 'gradient')
                            <input type="text" value="{{ $bgValue }}" placeholder="linear-gradient(135deg, #6366f1, #ec4899)"
                                wire:model.live="blocks.{{ $selectedIndex }}.data.style.background.value"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                        @else
                            <div class="flex items-center gap-2 flex-wrap mb-2">
                                @foreach (['#eef2ff', '#ffffff', '#111827', '#f3f4f6', '#fde68a'] as $color)
                                    <x-ui.color-swatch :color="$color" :selected="$bgValue === $color"
                                        wire:click="$set('blocks.{{ $selectedIndex }}.data.style.background.value', '{{ $color }}')" />
                                @endforeach
                            </div>
                            <div class="flex items-center gap-2 rounded-lg border border-gray-200 px-2.5 py-2">
                                <input type="color" value="{{ $bgValue ?: '#eef2ff' }}"
                                    wire:model.live="blocks.{{ $selectedIndex }}.data.style.background.value"
                                    class="w-6 h-6 rounded-full border-0 shrink-0 cursor-pointer">
                                <span class="w-full text-xs font-medium text-gray-700 uppercase">{{ $bgValue ?: '—' }}</span>
                            </div>
                        @endif
                    </label>
                @endif
            </x-builder.property-section>

            @if ($selectedBlock['type'] === 'button')
                <x-builder.property-section title="Button Styles" icon="cursor">
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ([
                            'gradient' => ['Gradient', 'bg-gradient-to-r from-indigo-500 to-violet-600 text-white'],
                            'filled' => ['Filled', 'bg-gray-900 text-white'],
                            'outline' => ['Outline', 'border-2 border-gray-900 text-gray-900'],
                            'soft' => ['Soft', 'bg-white border border-black/5 shadow-sm text-gray-900'],
                        ] as $value => [$label, $previewClasses])
                            @php $isActive = ($selectedBlock['data']['variant'] ?? 'filled') === $value; @endphp
                            <button type="button"
                                wire:click="$set('blocks.{{ $selectedIndex }}.data.variant', '{{ $value }}')"
                                @class([
                                    'rounded-xl p-3 flex flex-col items-center gap-2 transition-colors',
                                    'border-2 border-indigo-500 bg-indigo-50/60' => $isActive,
                                    'border border-gray-200 hover:border-indigo-300' => !$isActive,
                                ])>
                                <span @class(['w-full rounded-lg text-[11px] font-semibold text-center py-2', $previewClasses])>{{ $label }}</span>
                                <span @class([
                                    'text-[10px] font-medium',
                                    'text-indigo-600' => $isActive,
                                    'text-gray-500' => !$isActive,
                                ])>{{ $isActive ? 'Selected' : $label }}</span>
                            </button>
                        @endforeach
                    </div>
                </x-builder.property-section>
            @endif
        @elseif($selectedSocialLink)
            <x-builder.property-section title="Link" icon="social" :open="true">
                <label class="block">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">Network</p>
                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 bg-gray-50">
                        <x-ui.icon :name="$selectedSocialLink['network']" class="w-4 h-4 text-gray-600" />
                        <span
                            class="text-xs font-medium text-gray-700 capitalize">{{ str_replace('-', ' ', $selectedSocialLink['network']) }}</span>
                    </div>
                </label>
                <label class="block">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">URL</p>
                    <input type="text" wire:model.live="socialLinks.{{ $selectedSocialIndex }}.url"
                        placeholder="https://"
                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                </label>
                <button type="button" wire:click="removeSocialLink('{{ $selectedSocialLink['id'] }}')"
                    class="w-full inline-flex items-center justify-center gap-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 text-xs font-medium px-3 py-2 transition-colors">
                    <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                    Remove link
                </button>
            </x-builder.property-section>
        @else
            <x-builder.property-section title="Profile" icon="swatch" :open="true">
                <div>
                    <p class="text-xs font-medium text-gray-600 mb-2">Photo</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0 flex items-center justify-center">
                            @if ($photoUrl)
                                <img src="{{ $photoUrl }}" class="w-full h-full object-cover">
                            @else
                                <x-ui.icon name="image" class="w-4 h-4 text-gray-300" />
                            @endif
                        </div>
                        <div class="flex-1 flex items-center gap-2">
                            <label
                                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                                <span wire:loading.remove
                                    wire:target="profilePhotoUpload">{{ $photoUrl ? 'Replace' : 'Upload' }}</span>
                                <span wire:loading wire:target="profilePhotoUpload">Uploading…</span>
                                <input type="file" wire:model="profilePhotoUpload"
                                    accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                            </label>
                            @if ($photoUrl)
                                <button type="button" wire:click="removeProfilePhoto"
                                    class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                    title="Remove">
                                    <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                </button>
                            @endif
                        </div>
                    </div>
                    @error('profilePhotoUpload')
                        <p class="mt-1.5 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                    @if ($profilePhotoProcessing)
                        <p wire:poll.2s="pollProfilePhotoStatus" class="mt-1.5 text-[11px] text-gray-400">
                            Processing image…
                        </p>
                    @endif
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-600 mb-2">Cover photo</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 shrink-0 flex items-center justify-center">
                            @if ($coverPhotoUrl)
                                <img src="{{ $coverPhotoUrl }}" class="w-full h-full object-cover">
                            @else
                                <x-ui.icon name="image" class="w-4 h-4 text-gray-300" />
                            @endif
                        </div>
                        <div class="flex-1 flex items-center gap-2">
                            <label
                                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                                <span wire:loading.remove
                                    wire:target="coverPhotoUpload">{{ $coverPhotoUrl ? 'Replace' : 'Upload' }}</span>
                                <span wire:loading wire:target="coverPhotoUpload">Uploading…</span>
                                <input type="file" wire:model="coverPhotoUpload"
                                    accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                            </label>
                            @if ($coverPhotoUrl)
                                <button type="button" wire:click="removeCoverPhoto"
                                    class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                    title="Remove">
                                    <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                </button>
                            @endif
                        </div>
                    </div>
                    @error('coverPhotoUpload')
                        <p class="mt-1.5 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    @php
                        $bgIsImage = ($theme['background']['type'] ?? null) === 'image';
                        $bgUrl = $bgIsImage ? \App\Support\ImageProcessor::url($theme['background']['path'] ?? null) : null;
                    @endphp
                    <p class="text-xs font-medium text-gray-600 mb-2">Background photo</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0 flex items-center justify-center">
                            @if ($bgUrl)
                                <img src="{{ $bgUrl }}" class="w-full h-full object-cover">
                            @else
                                <x-ui.icon name="image" class="w-4 h-4 text-gray-300" />
                            @endif
                        </div>
                        <div class="flex-1 flex items-center gap-2">
                            <label
                                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                                <span wire:loading.remove
                                    wire:target="backgroundImageUpload">{{ $bgUrl ? 'Replace' : 'Upload' }}</span>
                                <span wire:loading wire:target="backgroundImageUpload">Uploading…</span>
                                <input type="file" wire:model="backgroundImageUpload"
                                    accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                            </label>
                            @if ($bgUrl)
                                <button type="button" wire:click="removeBackgroundImage"
                                    class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                    title="Remove">
                                    <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                </button>
                            @endif
                        </div>
                    </div>
                    @error('backgroundImageUpload')
                        <p class="mt-1.5 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <label class="block">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">Name</p>
                    <input type="text" wire:model.live="profileName"
                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
                </label>
                <label class="block">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">Bio</p>
                    <textarea wire:model.live="profileBio" rows="4"
                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"></textarea>
                </label>
            </x-builder.property-section>
        @endif
    </div>
</aside>
