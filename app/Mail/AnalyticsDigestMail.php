<?php

namespace App\Mail;

use App\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class AnalyticsDigestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Page $page,
        public int $viewCount,
        public int $clickCount,
        public Collection $topLinks,
    ) {}

    public function build(): self
    {
        return $this->subject('Your daily LinkNest digest')
            ->markdown('emails.analytics-digest');
    }
}
