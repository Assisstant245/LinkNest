@props(['data'])

<div class="flex items-center justify-center gap-2.5 py-2">
    @forelse(($data['networks'] ?? []) as $network)
        <x-builder.social-icon :network="$network" :icon-bg="$data['iconBg'] ?? null" />
    @empty
        <span class="text-xs text-gray-400">No social links selected</span>
    @endforelse
</div>
