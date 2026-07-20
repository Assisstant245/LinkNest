@props(['data' => []])

@php $imageUrl = \App\Support\ImageProcessor::url($data['path'] ?? null); @endphp

@if($imageUrl)
    <img src="{{ $imageUrl }}" alt="{{ $data['alt'] ?? '' }}"
        class="w-full object-cover" style="border-radius: var(--token-card-radius, 12px);">
@else
    <x-builder.blocks.placeholder icon="image" label="Image placeholder" />
@endif
