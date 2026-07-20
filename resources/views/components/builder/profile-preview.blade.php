@props(['name' => '', 'bio' => '', 'photoUrl' => null, 'socialLinks' => [], 'selectedSocialLinkId' => null, 'availableSocialNetworks' => []])

@php
$initials = collect(preg_split('/\s+/', trim($name)))
    ->filter()
    ->map(fn ($word) => mb_strtoupper(mb_substr(ltrim($word, '@'), 0, 1)))
    ->take(2)
    ->implode('') ?: '·';
@endphp

<div class="flex flex-col items-center text-center pt-8 pb-5 px-6" style="font-family: var(--token-font, inherit);">
    <div class="w-20 h-20 rounded-full p-[3px]" style="background: linear-gradient(135deg, var(--token-primary, #6366f1), var(--token-secondary, #8b5cf6), var(--token-accent, #ec4899));">
        <div class="w-full h-full rounded-full p-[3px]" style="background: var(--token-surface, #ffffff);">
            @if($photoUrl)
                <img src="{{ $photoUrl }}" alt="{{ $name }}" class="w-full h-full rounded-full object-cover">
            @else
                <div class="w-full h-full rounded-full flex items-center justify-center font-semibold text-lg" style="background: var(--token-border, #e5e7eb); color: var(--token-text, #6b7280);">
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
        @foreach($socialLinks as $link)
            <div class="relative" wire:key="social-link-{{ $link['id'] }}">
                @if($selectedSocialLinkId === $link['id'])
                    <div class="absolute -top-7 left-1/2 -translate-x-1/2 flex items-center gap-1 bg-gray-900 text-white rounded-md px-1.5 py-1 shadow-lg z-10 whitespace-nowrap">
                        <button type="button" wire:click.stop="removeSocialLink('{{ $link['id'] }}')" class="p-0.5 hover:text-red-300" title="Delete">
                            <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                        </button>
                    </div>
                @endif

                <div
                    wire:click.stop.prevent="selectSocialLink('{{ $link['id'] }}')"
                    @class([
                        'rounded-full cursor-pointer transition-shadow',
                        'ring-2 ring-indigo-500 ring-offset-2' => $selectedSocialLinkId === $link['id'],
                    ])
                >
                    <x-builder.social-icon :network="$link['network']" />
                </div>
            </div>
        @endforeach

        <div class="relative" x-data="{ open: false }">
            <button
                type="button"
                @click.stop="open = !open"
                @click.outside="open = false"
                class="w-9 h-9 rounded-full border border-dashed flex items-center justify-center text-gray-400 hover:text-indigo-500 hover:border-indigo-400 transition-colors"
                style="border-color: var(--token-border, #e5e7eb);"
                title="Add social link"
            >
                <x-ui.icon name="plus" class="w-4 h-4" />
            </button>

            <div
                x-show="open"
                x-cloak
                x-transition
                class="absolute z-20 top-11 left-1/2 -translate-x-1/2 bg-white border border-gray-200 rounded-xl shadow-lg p-2 flex gap-1.5 w-max"
                @click.stop
            >
                @forelse($availableSocialNetworks as $network)
                    <button
                        type="button"
                        wire:click="addSocialLink('{{ $network }}')"
                        @click="open = false"
                        class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-indigo-300 hover:text-indigo-600 transition-colors"
                        title="Add {{ $network }}"
                    >
                        <x-ui.icon :name="$network" class="w-4 h-4" />
                    </button>
                @empty
                    <span class="text-[11px] text-gray-400 px-2 py-1.5 whitespace-nowrap">All networks added</span>
                @endforelse
            </div>
        </div>
    </div>
</div>
