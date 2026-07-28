@php
    $ranges = ['7d' => '7 days', '30d' => '30 days', '90d' => '90 days', 'all' => 'All time'];
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Analytics</h1>
            <p class="mt-1 text-sm text-gray-500">Views, clicks, and where your traffic comes from.</p>
        </div>

        @if ($isPro)
        <x-ui.segmented>
            @foreach ($ranges as $value => $label)
                <x-ui.segment name="range" :value="$value" :active="$range === $value"
                    wire:click="setRange('{{ $value }}')">
                    {{ $label }}
                </x-ui.segment>
            @endforeach
        </x-ui.segmented>
        @endif
    </div>

    @if (!$isPro)
        <div class="mt-8 text-center py-16 border-2 border-dashed border-gray-200 rounded-2xl">
            <x-ui.icon name="lock" class="w-6 h-6 mx-auto text-amber-500" />
            <p class="mt-3 text-sm font-medium text-gray-700">Analytics is a Pro feature</p>
            <p class="mt-1 text-xs text-gray-400">Upgrade to see views, clicks, and traffic sources for your page.</p>
            <a href="{{ route('billing') }}" class="mt-4 inline-flex items-center justify-center rounded-lg bg-indigo-600 text-white text-xs font-semibold px-4 py-2 hover:bg-indigo-500 transition-colors">
                Upgrade to Pro
            </a>
        </div>
    @elseif (!$page)
        <div class="mt-8 text-center text-sm text-gray-400 py-16 border-2 border-dashed border-gray-200 rounded-2xl">
            No page yet — head to the Builder and save a page to start collecting analytics.
        </div>
    @elseif($totalViews == 0 && $totalClicks == 0)
        <div class="mt-8 text-center text-sm text-gray-400 py-16 border-2 border-dashed border-gray-200 rounded-2xl">
            No analytics data yet.
        </div>
    @else
        <div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs text-gray-500">Total views</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 tabular-nums">{{ number_format($totalViews) }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs text-gray-500">Total clicks</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 tabular-nums">{{ number_format($totalClicks) }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs text-gray-500">Click-through rate</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 tabular-nums">{{ $clickThroughRate }}%</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs text-gray-500">Views ({{ $ranges[$range] }})</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 tabular-nums">{{ number_format($rangeViews) }}</p>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">
            <h2 class="text-sm font-semibold text-gray-900 mb-4">Traffic over time</h2>
            <div wire:key="chart-{{ $range }}" wire:ignore class="h-64">
                <canvas x-data x-init="initTrafficChart($el, @js($trafficLabels), @js($trafficData))"></canvas>
            </div>
        </div>

        <div class="mt-6 grid lg:grid-cols-2 gap-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-5">
                <h2 class="text-sm font-semibold text-gray-900 mb-4">Top-performing links</h2>

                @if ($topLinks->isEmpty())
                    <p class="text-xs text-gray-400">No link blocks yet.</p>
                @else
                    @php $maxClicks = max(1, $topLinks->max('clicks')); @endphp
                    <div class="space-y-3">
                        @foreach ($topLinks as $link)
                            <div>
                                <div class="flex items-center justify-between text-xs mb-1">
                                    <span class="font-medium text-gray-700 truncate">{{ $link['label'] }}</span>
                                    <span class="text-gray-400 tabular-nums">{{ $link['clicks'] }}</span>
                                </div>
                                <div class="h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-indigo-500"
                                        style="width: {{ ($link['clicks'] / $maxClicks) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5">
                <h2 class="text-sm font-semibold text-gray-900 mb-4">Top platforms</h2>

                @if (empty($platformLabels))
                    <p class="text-xs text-gray-400">No views in this range yet.</p>
                @else
                    <div wire:key="platforms-{{ $range }}" wire:ignore class="h-56">
                        <canvas x-data x-init="initPlatformsChart($el, @js($platformLabels), @js($platformData))"></canvas>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
