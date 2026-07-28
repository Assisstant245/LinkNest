@props([
    'name' => '',
    'bio' => '',
    'photoUrl' => null,
    'coverUrl' => null,
    'socialLinks' => [],
    'selectedSocialLinkId' => null,
    'availableSocialNetworks' => [],
    'editable' => true,
])
@php
    $initials =
        collect(preg_split('/\s+/', trim($name)))
            ->filter()
            ->map(fn($word) => mb_strtoupper(mb_substr(ltrim($word, '@'), 0, 1)))
            ->take(2)
            ->implode('') ?:
        '·';
@endphp

<div style="font-family: var(--token-font, inherit);">
    {{-- Cover --}}
    <div class="relative h-[300px] overflow-hidden rounded-b-2xl">
        @if ($coverUrl)
            <img src="{{ $coverUrl }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0"
                style="background: linear-gradient(135deg, var(--token-primary, #6366f1), var(--token-secondary, #8b5cf6), var(--token-accent, #ec4899));">
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-transparent"></div>
    </div>

    <div class="relative -mt-10 flex flex-col items-center text-center px-6 pb-5">
    <div class="w-20 h-20 rounded-full p-[3px]"
        style="background: linear-gradient(135deg, var(--token-primary, #6366f1), var(--token-secondary, #8b5cf6), var(--token-accent, #ec4899));">
        <div class="w-full h-full rounded-full p-[3px]" style="background: var(--token-surface, #ffffff);">
            @if ($photoUrl)
                <img src="{{ $photoUrl }}" alt="{{ $name }}" class="w-full h-full rounded-full object-cover">
            @else
                <div class="w-full h-full rounded-full flex items-center justify-center font-semibold text-lg"
                    style="background: var(--token-border, #e5e7eb); color: var(--token-text, #6b7280);">
                    {{ $initials }}
                </div>
            @endif
        </div>
    </div>

    <h1 class="mt-3 text-base font-bold" style="color: var(--token-text, #111827);">{{ $name }}</h1>
    <p class="mt-1 text-xs leading-relaxed max-w-[220px] opacity-70" style="color: var(--token-text, #6b7280);">
        {{ $bio }}
    </p>

    <div class="flex items-center gap-2.5 mt-4 flex-wrap justify-center" wire:click.stop>
        @foreach ($socialLinks as $link)
            <div class="relative" wire:key="social-link-{{ $link['id'] }}">
                @if ($editable && $selectedSocialLinkId === $link['id'])
                    <div
                        class="absolute -top-7 left-1/2 -translate-x-1/2 flex items-center gap-1 bg-gray-900 text-white rounded-md px-1.5 py-1 shadow-lg z-10 whitespace-nowrap">
                        <button type="button" wire:click.stop="removeSocialLink('{{ $link['id'] }}')"
                            class="p-0.5 hover:text-red-300" title="Delete">
                            <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                        </button>
                    </div>
                @endif

                <div @if ($editable) wire:click.stop.prevent="selectSocialLink('{{ $link['id'] }}')" @endif
                    @class([
                        'rounded-full cursor-pointer transition-shadow',
                        'ring-2 ring-indigo-500 ring-offset-2' =>
                            $selectedSocialLinkId === $link['id'],
                    ])>
                    <x-builder.social-icon :network="$link['network']" />
                </div>
            </div>
        @endforeach

        @if ($editable)
            <div class="relative" x-data="{ open: false }">
                <button type="button" @click.stop="open = !open" @click.outside="open = false"
                    class="w-9 h-9 rounded-full border border-dashed flex items-center justify-center">
                    <x-ui.icon name="plus" />
                </button>

                <div x-show="open" x-cloak
                    class="absolute top-12 left-1/2 -translate-x-1/2 bg-white border rounded-lg shadow-lg p-2 z-50">
                    @forelse($availableSocialNetworks as $network)
                        <button type="button" wire:click="addSocialLink('{{ $network }}')" @click="open = false"
                            class="flex items-center gap-2 w-full px-3 py-2 hover:bg-gray-100 rounded">
                            <x-builder.social-icon :network="$network" />

                            <span>{{ ucfirst($network) }}</span>
                        </button>
                    @empty
                        <span class="text-gray-500 text-sm">All networks added</span>
                    @endforelse
                </div>
            </div>
        @endif
    </div>
    </div>
</div>
