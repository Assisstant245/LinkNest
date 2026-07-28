@props(['block', 'selected' => false])

@php
$icons = [
    'heading' => 'heading', 'text' => 'text', 'button' => 'button', 'social' => 'social',
    'divider' => 'divider', 'spacer' => 'spacer', 'image' => 'image', 'video' => 'video', 'contact' => 'contact',
];
@endphp

<div
    {{ $attributes }}
    wire:key="block-{{ $block['id'] }}"
    data-id="{{ $block['id'] }}"
    wire:click.stop="selectBlock('{{ $block['id'] }}')"
    class="relative"
>
    @if($selected)
        <div class="absolute -top-7 right-0 flex items-center gap-1 bg-gray-900 text-white rounded-md px-1.5 py-1 shadow-lg z-10">
            <button type="button" wire:click.stop="duplicateBlock('{{ $block['id'] }}')" class="p-0.5 hover:text-indigo-300" title="Duplicate">
                <x-ui.icon name="duplicate" class="w-3.5 h-3.5" />
            </button>
            <button type="button" wire:click.stop="deleteBlock('{{ $block['id'] }}')" class="p-0.5 hover:text-red-300" title="Delete">
                <x-ui.icon name="trash" class="w-3.5 h-3.5" />
            </button>
            <span class="w-px h-3 bg-white/20"></span>
            <button type="button" data-drag-handle class="p-0.5 cursor-grab" title="Drag to reorder">
                <x-ui.icon name="grip" class="w-3.5 h-3.5" />
            </button>
        </div>
    @endif

    <div @class([
        'rounded-xl transition-all duration-150 hover:[transform:var(--token-hover-transform)] hover:[opacity:var(--token-hover-opacity)]',
        'ring-2 ring-indigo-500 ring-offset-2 ring-offset-gray-50' => $selected,
    ])>
        <x-builder.block-style :data="$block['data']">
            <x-dynamic-component :component="'builder.blocks.' . $block['type']" :data="$block['data']" />
        </x-builder.block-style>
    </div>
</div>
