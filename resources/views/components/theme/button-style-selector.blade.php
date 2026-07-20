@props(['model', 'value'])

<x-ui.segmented class="w-full [&>*]:flex-1">
    @foreach(['filled' => 'Filled', 'gradient' => 'Gradient', 'outline' => 'Outline'] as $val => $labelText)
        <x-ui.segment name="theme-button-style" :value="$val" :active="$value === $val" wire:click="$set('{{ $model }}', '{{ $val }}')">
            {{ $labelText }}
        </x-ui.segment>
    @endforeach
</x-ui.segmented>
