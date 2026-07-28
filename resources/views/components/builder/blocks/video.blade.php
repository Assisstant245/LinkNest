@props(['data' => []])

@php
    $localUrl = \App\Support\VideoProcessor::url($data['path'] ?? null);
    $embed = $localUrl ? null : \App\Support\VideoEmbed::resolve($data['url'] ?? null);
@endphp

@if ($localUrl)
    <div class="relative w-full aspect-video overflow-hidden" style="border-radius: var(--token-card-radius, 12px);">
        <video controls class="absolute inset-0 w-full h-full object-cover" src="{{ $localUrl }}"></video>
    </div>
@elseif ($embed)
    <div class="relative w-full aspect-video overflow-hidden" style="border-radius: var(--token-card-radius, 12px);">
        @if ($embed['provider'] === 'file')
            <video controls class="absolute inset-0 w-full h-full object-cover" src="{{ $embed['embedUrl'] }}"></video>
        @else
            <iframe
                src="{{ $embed['embedUrl'] }}"
                class="absolute inset-0 w-full h-full"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
            ></iframe>
        @endif
    </div>
@else
    <x-builder.blocks.placeholder icon="video" label="Video placeholder" />
@endif
