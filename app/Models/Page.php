<?php

namespace App\Models;

use App\Support\ImageProcessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'user_id', 'profile_name', 'profile_bio', 'profile_photo_path', 'cover_photo_path', 'theme', 'social_links',
        'slug', 'custom_domain', 'published_at',
    ];

    protected $casts = [
        'theme' => 'array',
        'social_links' => 'array',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class)->orderBy('position');
    }

    public function pageViews(): HasMany
    {
        return $this->hasMany(PageView::class);
    }

    public function linkClicks(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    public function publicUrl(): string
    {
        if ($this->custom_domain) {
            return 'https://' . $this->custom_domain;
        }

        return url('/' . $this->slug);
    }

    public function profilePhotoUrl(): ?string
    {
        return ImageProcessor::url($this->profile_photo_path);
    }

    public function coverPhotoUrl(): ?string
    {
        return ImageProcessor::url($this->cover_photo_path);
    }

    protected static function booted(): void
    {
        static::deleting(function (Page $page) {
            ImageProcessor::delete($page->profile_photo_path);
            ImageProcessor::delete($page->cover_photo_path);
            ImageProcessor::delete($page->theme['background']['path'] ?? null);

            foreach ($page->links as $link) {
                ImageProcessor::delete($link->data['path'] ?? null);
            }
        });
    }
}
