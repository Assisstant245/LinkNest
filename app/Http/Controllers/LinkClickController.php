<?php

namespace App\Http\Controllers;

use App\Models\Link;

class LinkClickController extends Controller
{
    public function redirect(string $uuid)
    {
        $link = Link::where('uuid', $uuid)->firstOrFail();

        $url = $link->data['url'] ?? null;

        abort_if(! $url, 404);

        $link->clicks()->create([
            'page_id' => $link->page_id,
        ]);

        return redirect()->away($url);
    }
}
