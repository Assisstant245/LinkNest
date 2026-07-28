<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->profile_name }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center py-10">

    @php
        $productBlocks = $page->links->where('type', 'product');
        $linkBlocks = $page->links->reject(fn ($link) => $link->type === 'product');
        $hasProducts = $productBlocks->isNotEmpty();
    @endphp

    <x-builder.device-preview device="mobile" :theme="$page->theme">
        <x-builder.profile-preview :name="$page->profile_name" :bio="$page->profile_bio" :photo-url="$page->profilePhotoUrl()" :cover-url="$page->coverPhotoUrl()" :social-links="$page->social_links"
            :editable="false" />

        @if ($hasProducts)
            <div class="px-5 mb-4">
                <div class="flex items-center gap-1 rounded-full p-1" style="background: var(--token-border, #f1f5f9);">
                    <button type="button" id="tab-btn-links" onclick="linknestSwitchTab('links')"
                        class="flex-1 text-center text-sm font-semibold rounded-full py-2 transition-colors"
                        style="background: var(--token-surface, #fff); color: var(--token-text, #111827); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Links
                    </button>
                    <button type="button" id="tab-btn-shop" onclick="linknestSwitchTab('shop')"
                        class="flex-1 text-center text-sm font-semibold rounded-full py-2 transition-colors"
                        style="background: transparent; color: var(--token-text, #6b7280); opacity: 0.7; box-shadow: none;">
                        Shop
                    </button>
                </div>
            </div>
        @endif

        <div id="tab-panel-links" class="space-y-3 px-5 pb-6">
            @foreach ($linkBlocks as $link)
                <x-builder.block-style :data="$link->data">
                    @if ($link->type === 'button' && !empty($link->data['url']))
                        <a href="{{ route('link.redirect', $link->uuid) }}" target="_blank" rel="noopener noreferrer"
                            class="block">
                            <x-builder.link-button :label="$link->data['label'] ?? 'Link'" :subtitle="$link->data['subtitle'] ?? null" :icon="$link->data['icon'] ?? null"
                                :variant="$link->data['variant'] ?? 'filled'" :thumbnail="$link->data['thumbnail'] ?? false" :featured="$link->data['featured'] ?? false" />
                        </a>
                    @elseif ($link->type === 'contact')
                        <div class="flex flex-col gap-5">
                            @if (!empty($link->data['email']))
                                <a href="mailto:{{ $link->data['email'] }}" class="block">
                                    <x-builder.link-button label="Email" :subtitle="$link->data['email']" icon="mail"
                                        variant="soft" />
                                </a>
                            @endif
                            @if (!empty($link->data['phone']))
                                <a href="tel:{{ $link->data['phone'] }}" class="block">
                                    <x-builder.link-button label="Call" :subtitle="$link->data['phone']" icon="lucide:phone"
                                        variant="soft" />
                                </a>
                            @endif
                        </div>
                    @else
                        <x-dynamic-component :component="'builder.blocks.' . $link->type" :data="$link->data" />
                    @endif
                </x-builder.block-style>
            @endforeach
        </div>

        @if ($hasProducts)
            <div id="tab-panel-shop" class="grid grid-cols-2 gap-3 px-5 pb-6" style="display: none;">
                @foreach ($productBlocks as $product)
                    <a href="{{ route('link.redirect', $product->uuid) }}" target="_blank" rel="noopener noreferrer" class="block">
                        <x-builder.blocks.product :data="$product->data" />
                    </a>
                @endforeach
            </div>

            <script>
                function linknestSwitchTab(tab) {
                    document.getElementById('tab-panel-links').style.display = tab === 'links' ? '' : 'none';
                    document.getElementById('tab-panel-shop').style.display = tab === 'shop' ? '' : 'none';

                    var linksBtn = document.getElementById('tab-btn-links');
                    var shopBtn = document.getElementById('tab-btn-shop');
                    var active = tab === 'links' ? linksBtn : shopBtn;
                    var inactive = tab === 'links' ? shopBtn : linksBtn;

                    active.style.background = 'var(--token-surface, #fff)';
                    active.style.boxShadow = '0 1px 2px rgba(0,0,0,0.05)';
                    active.style.opacity = '1';
                    inactive.style.background = 'transparent';
                    inactive.style.boxShadow = 'none';
                    inactive.style.opacity = '0.7';
                }
            </script>
        @endif

        @unless ($page->user?->isPro())
            <div class="pb-6 flex justify-center">
                <span
                    class="inline-flex items-center gap-1.5 text-[11px] font-medium text-gray-400 bg-white/70 border border-gray-100 rounded-full px-3 py-1.5">
                    <svg viewBox="0 0 24 24" class="w-3 h-3" fill="currentColor">
                        <path d="M12 2.5c3 1.5 5 4.8 5 9 0 2-1 4-1 4l-4 2-4-2s-1-2-1-4c0-4.2 2-7.5 5-9Z" />
                    </svg>
                    Made with LinkForge
                </span>
            </div>
        @endunless
    </x-builder.device-preview>

</body>

</html>
