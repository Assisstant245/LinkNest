@props(['presets', 'activePresetSlug'])

<div>
    <h3 class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 mb-3">Presets</h3>
    <div class="grid grid-cols-2 gap-2.5">
        @foreach($presets as $preset)
            <x-theme.card
                :slug="$preset['slug']"
                :name="$preset['name']"
                :tokens="$preset['tokens']"
                :active="$activePresetSlug === $preset['slug']"
                :pro="$preset['pro'] ?? false"
            />
        @endforeach
    </div>
</div>
