<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8 sm:py-10" x-data="{ tab: 'links' }">
    {{-- Cover + avatar hero --}}
    <div class="relative h-56 sm:h-64 rounded-2xl overflow-hidden">
        @if ($page->coverPhotoUrl())
            <img src="{{ $page->coverPhotoUrl() }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0"
                style="background: linear-gradient(135deg, {{ $page->theme['colors']['primary'] ?? '#6366f1' }}, {{ $page->theme['colors']['secondary'] ?? '#8b5cf6' }}, {{ $page->theme['colors']['accent'] ?? '#ec4899' }});">
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/5 to-transparent"></div>
    </div>

    <div class="relative -mt-12 flex flex-col items-center text-center px-4">
        <div class="w-24 h-24 rounded-full p-1 bg-white shadow-md">
            <div class="w-full h-full rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                @if ($page->profilePhotoUrl())
                    <img src="{{ $page->profilePhotoUrl() }}" class="w-full h-full object-cover">
                @else
                    <span class="text-lg font-semibold text-gray-400">{{ mb_strtoupper(mb_substr($page->profile_name, 0, 1)) }}</span>
                @endif
            </div>
        </div>

        <h1 class="mt-3 text-xl font-bold text-gray-900">{{ $page->profile_name }}</h1>
        @if ($page->profile_bio)
            <p class="mt-1 text-sm text-gray-500 max-w-md">{{ $page->profile_bio }}</p>
        @endif

        {{-- Stats --}}
        <div class="mt-5 flex items-center gap-3">
            <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5">
                <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <x-ui.icon name="link" class="w-4 h-4" />
                </span>
                <div class="text-left">
                    <p class="text-sm font-bold text-gray-900 leading-none">{{ $linkCount }}</p>
                    <p class="text-[11px] text-gray-400">Links</p>
                </div>
            </div>
            <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5">
                <span class="w-8 h-8 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center">
                    <x-builder.link-icon name="lucide:shopping-bag" class="w-4 h-4" />
                </span>
                <div class="text-left">
                    <p class="text-sm font-bold text-gray-900 leading-none">{{ $productCount }}</p>
                    <p class="text-[11px] text-gray-400">Products</p>
                </div>
            </div>
            <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5">
                <span class="w-8 h-8 rounded-full bg-violet-50 text-violet-600 flex items-center justify-center">
                    <x-ui.icon name="eye" class="w-4 h-4" />
                </span>
                <div class="text-left">
                    <p class="text-sm font-bold text-gray-900 leading-none">{{ number_format($viewCount) }}</p>
                    <p class="text-[11px] text-gray-400">Views</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-5 flex items-center gap-2">
            <a href="{{ $page->publicUrl() }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-gray-300 text-sm font-medium px-4 py-2 transition-colors">
                <x-ui.icon name="eye" class="w-4 h-4" />
                View Page
            </a>
            <button type="button"
                x-data="{ copied: false }"
                @click="navigator.clipboard.writeText('{{ $page->publicUrl() }}'); copied = true; setTimeout(() => copied = false, 1500)"
                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-gray-300 text-sm font-medium px-4 py-2 transition-colors">
                <x-ui.icon name="link" class="w-4 h-4" />
                <span x-text="copied ? 'Copied!' : 'Share'"></span>
            </button>
            <button type="button" wire:click="editInBuilder"
                class="inline-flex items-center gap-1.5 rounded-lg bg-gradient-to-b from-indigo-500 to-indigo-600 text-white shadow-sm shadow-indigo-500/30 hover:from-indigo-400 hover:to-indigo-600 text-sm font-medium px-4 py-2 transition-colors">
                <x-builder.link-icon name="lucide:pencil" class="w-4 h-4" />
                Edit
            </button>
        </div>
    </div>

    {{-- Links / Shop tabs --}}
    <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-2">
        <div class="flex items-center gap-1 rounded-xl bg-gray-50 p-1 max-w-xs mx-auto">
            <button type="button" @click="tab = 'links'"
                :class="tab === 'links' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500'"
                class="flex-1 text-center text-sm font-semibold rounded-lg py-2 transition-colors">
                Links
            </button>
            <button type="button" @click="tab = 'shop'"
                :class="tab === 'shop' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500'"
                class="flex-1 text-center text-sm font-semibold rounded-lg py-2 transition-colors">
                Shop
            </button>
        </div>

        <div x-show="tab === 'links'" class="p-4">
            @if ($links->isEmpty())
                <p class="text-sm text-gray-400 text-center py-8">No links yet — add some in the Builder.</p>
            @else
                <div class="space-y-2">
                    @foreach ($links as $link)
                        <div class="flex items-center gap-3 rounded-xl border border-gray-100 px-4 py-3">
                            <span class="w-9 h-9 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-500 shrink-0">
                                <x-builder.link-icon :name="$link->data['icon'] ?? 'link'" class="w-4 h-4" />
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">{{ $link->data['label'] ?? ucfirst($link->type) }}</p>
                                @if (!empty($link->data['subtitle']))
                                    <p class="text-xs text-gray-400 truncate">{{ $link->data['subtitle'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div x-show="tab === 'shop'" x-cloak class="p-4">
            @if ($products->isEmpty())
                <p class="text-sm text-gray-400 text-center py-8">No products yet — add some from the Shop tab in the Builder.</p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach ($products as $product)
                        <x-builder.blocks.product :data="$product->data" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
