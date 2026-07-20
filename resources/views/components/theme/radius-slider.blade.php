@props(['label' => 'Radius', 'model', 'value', 'min' => 0, 'max' => 48, 'unit' => 'px'])

<x-ui.slider :label="$label" :value="$value" :min="$min" :max="$max" :unit="$unit" wire:model.live="{{ $model }}" />
