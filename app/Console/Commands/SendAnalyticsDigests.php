<?php

namespace App\Console\Commands;

use App\Jobs\SendAnalyticsDigest;
use App\Models\Page;
use Illuminate\Console\Command;

class SendAnalyticsDigests extends Command
{
    protected $signature = 'digest:send-analytics';

    protected $description = 'Dispatch a daily analytics digest email for each Pro user\'s published page';

    public function handle(): int
    {
        $dispatched = 0;

        Page::whereNotNull('published_at')->with('user')->each(function (Page $page) use (&$dispatched) {
            if (! $page->user || ! $page->user->isPro()) {
                return;
            }

            SendAnalyticsDigest::dispatch($page);
            $dispatched++;
        });

        $this->info("Dispatched {$dispatched} analytics digest job(s).");

        return self::SUCCESS;
    }
}
