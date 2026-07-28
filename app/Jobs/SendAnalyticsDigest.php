<?php

namespace App\Jobs;

use App\Mail\AnalyticsDigestMail;
use App\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAnalyticsDigest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Page $page) {}

    public function handle(): void
    {
        $since = now()->subDay();

        $viewCount = $this->page->pageViews()->where('created_at', '>=', $since)->count();
        $clickCount = $this->page->linkClicks()->where('created_at', '>=', $since)->count();

        if ($viewCount === 0 && $clickCount === 0) {
            return;
        }

        $topLinks = $this->page->links()
            ->withCount(['clicks' => fn ($query) => $query->where('created_at', '>=', $since)])
            ->orderByDesc('clicks_count')
            ->take(5)
            ->get()
            ->map(fn ($link) => [
                'label' => $link->data['label'] ?? ucfirst($link->type),
                'clicks' => $link->clicks_count,
            ]);

        Mail::to($this->page->user->email)->send(
            new AnalyticsDigestMail($this->page, $viewCount, $clickCount, $topLinks)
        );
    }
}
