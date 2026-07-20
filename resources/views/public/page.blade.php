
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->profile_name }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-10">

    <x-builder.device-preview device="mobile" :theme="$page->theme">
        <x-builder.profile-preview
            :name="$page->profile_name"
            :bio="$page->profile_bio"
            :photo-url="$page->profilePhotoUrl()"
            :social-links="$page->social_links"
        />

        <div class="space-y-3 px-5 pb-6">
            @foreach ($page->links as $link)
                <x-builder.block-style :data="$link->data">
                    @if ($link->type === 'button' && !empty($link->data['url']))
                        <a href="{{ route('link.redirect', $link->uuid) }}" target="_blank" rel="noopener noreferrer" class="block">
                            <x-builder.link-button
                                :label="$link->data['label'] ?? 'Link'"
                                :subtitle="$link->data['subtitle'] ?? null"
                                :icon="$link->data['icon'] ?? null"
                                :variant="$link->data['variant'] ?? 'filled'"
                                :thumbnail="$link->data['thumbnail'] ?? false"
                            />
                        </a>
                    @else
                        <x-dynamic-component :component="'builder.blocks.' . $link->type" :data="$link->data" />
                    @endif
                </x-builder.block-style>
            @endforeach
        </div>

        @unless($page->user?->isPro())
            <div class="pb-6 flex justify-center">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-gray-400 bg-white/70 border border-gray-100 rounded-full px-3 py-1.5">
                    <svg viewBox="0 0 24 24" class="w-3 h-3" fill="currentColor"><path d="M12 2.5c3 1.5 5 4.8 5 9 0 2-1 4-1 4l-4 2-4-2s-1-2-1-4c0-4.2 2-7.5 5-9Z"/></svg>
                    Made with LinkForge
                </span>
            </div>
        @endunless
    </x-builder.device-preview>

</body>
</html>