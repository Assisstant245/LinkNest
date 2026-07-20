<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Support\ReferrerClassifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicPageController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $page = Page::where('slug', $slug)
            ->whereNotNull('published_at')
            ->with('links')
            ->firstOrFail();

        // Logged outside the cache so every visit is counted, cache hit or not.
        $page->pageViews()->create([
            'referrer' => $request->header('referer'),
            'platform' => ReferrerClassifier::classify($request->header('referer')),
            'user_agent' => $request->userAgent(),
        ]);

        $html = Cache::remember(
            "public-page:{$page->slug}",
            now()->addMinutes(15),
            fn () => view('public.page', ['page' => $page])->render()
        );

        return response($html);
    }
}
