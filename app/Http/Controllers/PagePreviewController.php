<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagePreviewController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->user_id === auth()->id(), 403);

        return view('public.page', ['page' => $page->load('links')]);
    }
}
