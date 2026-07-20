<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageView extends Model
{
    protected $fillable = [
        'page_id',
        'referrer',
        'platform',
        'user_agent',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
