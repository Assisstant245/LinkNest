<?php

namespace App\Livewire\Analytics;

use App\Models\Page;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Analytics'])]
class Dashboard extends Component
{
    public string $range = '7d';

    public function setRange(string $range): void
    {
        $this->range = $range;
    }

    protected function rangeStart(): ?Carbon
    {
        return match ($this->range) {
            '7d' => now()->subDays(6)->startOfDay(),
            '30d' => now()->subDays(29)->startOfDay(),
            '90d' => now()->subDays(89)->startOfDay(),
            default => null,
        };
    }

    public function render()
    {
        $isPro = auth()->user()->isPro();

        $page = Page::where('user_id', auth()->id())
        ->latest()
        ->first();

        if (! $isPro || ! $page) {
            return view('livewire.analytics.dashboard', [
                'isPro' => $isPro,
                'page' => null,
                'totalViews' => 0,
                'totalClicks' => 0,
                'rangeViews' => 0,
                'clickThroughRate' => 0,
                'trafficLabels' => [],
                'trafficData' => [],
                'topLinks' => collect(),
                'platformLabels' => [],
                'platformData' => [],
            ]);
        }

        $start = $this->rangeStart();

        $totalViews = $page->pageViews()->count();
        $totalClicks = $page->linkClicks()->count();
        $rangeViews = $page->pageViews()
            ->when($start, fn ($q) => $q->where('created_at', '>=', $start))
            ->count();

        $daily = $page->pageViews()
            ->when($start, fn ($q) => $q->where('created_at', '>=', $start))
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $trafficLabels = [];
        $trafficData = [];

        if ($start) {
            $cursor = $start->copy();
            while ($cursor->lte(now())) {
                $key = $cursor->toDateString();
                $trafficLabels[] = $cursor->format('M j');
                $trafficData[] = (int) ($daily[$key] ?? 0);
                $cursor->addDay();
            }
        } else {
            foreach ($daily as $day => $total) {
                $trafficLabels[] = Carbon::parse($day)->format('M j');
                $trafficData[] = (int) $total;
            }
        }

        $topLinks = $page->links()
            ->withCount('clicks')
            ->orderByDesc('clicks_count')
            ->get()
            ->map(fn ($link) => [
                'label' => $link->data['label'] ?? ucfirst($link->type),
                'clicks' => $link->clicks_count,
            ]);

        $platforms = $page->pageViews()
            ->when($start, fn ($q) => $q->where('created_at', '>=', $start))
            ->selectRaw('platform, COUNT(*) as total')
            ->groupBy('platform')
            ->orderByDesc('total')
            ->pluck('total', 'platform');

        return view('livewire.analytics.dashboard', [
            'isPro' => $isPro,
            'page' => $page,
            'totalViews' => $totalViews,
            'totalClicks' => $totalClicks,
            'rangeViews' => $rangeViews,
            'clickThroughRate' => $totalViews > 0 ? round($totalClicks / $totalViews * 100, 1) : 0,
            'trafficLabels' => $trafficLabels,
            'trafficData' => $trafficData,
            'topLinks' => $topLinks,
            'platformLabels' => $platforms->keys()->all(),
            'platformData' => $platforms->values()->all(),
        ]);
    }
}
