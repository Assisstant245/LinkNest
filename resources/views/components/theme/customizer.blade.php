@props(['theme'])

@php
$shadows = ['none' => 'None', 'soft' => 'Soft', 'strong' => 'Strong', 'glow' => 'Glow'];
@endphp

<div>
    <x-builder.property-section title="Colors" icon="swatch" :open="true">
        <x-theme.color-picker label="Primary" model="theme.colors.primary" :value="$theme['colors']['primary']" />
        <x-theme.color-picker label="Secondary" model="theme.colors.secondary" :value="$theme['colors']['secondary']" />
        <x-theme.color-picker label="Accent" model="theme.colors.accent" :value="$theme['colors']['accent']" />
        <x-theme.color-picker label="Background" model="theme.colors.background" :value="$theme['colors']['background']" />
        <x-theme.color-picker label="Surface" model="theme.colors.surface" :value="$theme['colors']['surface']" />
        <x-theme.color-picker label="Text" model="theme.colors.text" :value="$theme['colors']['text']" />
        <x-theme.color-picker label="Border" model="theme.colors.border" :value="$theme['colors']['border']" />
    </x-builder.property-section>

    <x-builder.property-section title="Typography" icon="typography">
        <x-theme.font-selector model="theme.typography.fontFamily" :value="$theme['typography']['fontFamily']" />
        <x-ui.slider label="Font size" unit="px" :min="10" :max="32" :value="$theme['typography']['fontSize']" wire:model.live="theme.typography.fontSize" />

        <div>
            <p class="text-xs font-medium text-gray-600 mb-2">Weight</p>
            <x-ui.segmented class="w-full [&>*]:flex-1">
                @foreach(['regular' => 'Regular', 'medium' => 'Medium', 'bold' => 'Bold'] as $val => $labelText)
                    <x-ui.segment name="theme-font-weight" :value="$val" :active="$theme['typography']['fontWeight'] === $val" wire:click="$set('theme.typography.fontWeight', '{{ $val }}')">
                        {{ $labelText }}
                    </x-ui.segment>
                @endforeach
            </x-ui.segmented>
        </div>

        <x-ui.slider label="Letter spacing" unit="px" :min="-2" :max="8" :value="$theme['typography']['letterSpacing']" wire:model.live="theme.typography.letterSpacing" />
        <x-ui.slider label="Line height" unit="x" :min="1" :max="2.2" :step="0.1" :value="$theme['typography']['lineHeight']" wire:model.live="theme.typography.lineHeight" />
    </x-builder.property-section>

    <x-builder.property-section title="Buttons" icon="cursor">
        <x-theme.radius-slider label="Corner radius" model="theme.buttons.radius" :value="$theme['buttons']['radius']" :max="32" />
        <x-ui.slider label="Height" unit="px" :min="32" :max="64" :value="$theme['buttons']['height']" wire:model.live="theme.buttons.height" />

        <div>
            <p class="text-xs font-medium text-gray-600 mb-2">Shadow</p>
            <x-ui.segmented class="w-full [&>*]:flex-1">
                @foreach($shadows as $val => $labelText)
                    <x-ui.segment name="theme-button-shadow" :value="$val" :active="$theme['buttons']['shadow'] === $val" wire:click="$set('theme.buttons.shadow', '{{ $val }}')">
                        {{ $labelText }}
                    </x-ui.segment>
                @endforeach
            </x-ui.segmented>
        </div>

        <div>
            <p class="text-xs font-medium text-gray-600 mb-2">Style</p>
            <x-theme.button-style-selector model="theme.buttons.style" :value="$theme['buttons']['style']" />
        </div>

        <label class="flex items-center justify-between">
            <span class="text-xs font-medium text-gray-600">Full width</span>
            <input type="checkbox" wire:model.live="theme.buttons.fullWidth" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/40">
        </label>
    </x-builder.property-section>

    <x-builder.property-section title="Background" icon="background">
        <x-theme.background-selector
            type-model="theme.background.type"
            value-model="theme.background.value"
            :type="$theme['background']['type']"
            :value="$theme['background']['value']"
            :path="$theme['background']['path'] ?? null"
        />
    </x-builder.property-section>

    <x-builder.property-section title="Cards" icon="spacing">
        <x-theme.radius-slider label="Corner radius" model="theme.cards.radius" :value="$theme['cards']['radius']" :max="32" />

        <div>
            <p class="text-xs font-medium text-gray-600 mb-2">Shadow</p>
            <x-ui.segmented class="w-full [&>*]:flex-1">
                @foreach($shadows as $val => $labelText)
                    <x-ui.segment name="theme-card-shadow" :value="$val" :active="$theme['cards']['shadow'] === $val" wire:click="$set('theme.cards.shadow', '{{ $val }}')">
                        {{ $labelText }}
                    </x-ui.segment>
                @endforeach
            </x-ui.segmented>
        </div>

        <x-ui.slider label="Padding" unit="px" :min="0" :max="32" :value="$theme['cards']['padding']" wire:model.live="theme.cards.padding" />
        <x-ui.slider label="Spacing between blocks" unit="px" :min="0" :max="32" :value="$theme['cards']['spacing']" wire:model.live="theme.cards.spacing" />
    </x-builder.property-section>

    <x-builder.property-section title="Animations" icon="cursor">
        <div class="grid grid-cols-2 gap-2">
            @foreach(['hoverScale' => 'Hover Scale', 'hoverLift' => 'Hover Lift', 'fade' => 'Fade', 'slide' => 'Slide'] as $key => $labelText)
                <button
                    type="button"
                    wire:click="$set('theme.animations.{{ $key }}', {{ $theme['animations'][$key] ? 'false' : 'true' }})"
                    @class([
                        'text-[11px] font-medium rounded-lg border px-2 py-1.5 transition-colors',
                        'border-indigo-500 bg-indigo-50 text-indigo-600' => $theme['animations'][$key],
                        'border-gray-200 text-gray-600 hover:border-indigo-300' => !$theme['animations'][$key],
                    ])
                >{{ $labelText }}</button>
            @endforeach
        </div>
    </x-builder.property-section>
</div>
