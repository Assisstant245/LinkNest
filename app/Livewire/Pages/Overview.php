<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Page Overview'])]
class Overview extends Component
{
    public Page $page;

    public function mount(Page $page): void
    {
        abort_unless($page->user_id === auth()->id(), 403);

        $this->page = $page;
    }

    public function editInBuilder()
    {
        session(['builder.page_id' => $this->page->id]);

        return redirect()->route('builder');
    }

    public function render()
    {
        $linkCount = $this->page->links()->where('type', '!=', 'product')->count();
        $productCount = $this->page->links()->where('type', 'product')->count();
        $viewCount = $this->page->pageViews()->count();

        $links = $this->page->links()->where('type', '!=', 'product')->get();
        $products = $this->page->links()->where('type', 'product')->get();

        return view('livewire.pages.overview', [
            'linkCount' => $linkCount,
            'productCount' => $productCount,
            'viewCount' => $viewCount,
            'links' => $links,
            'products' => $products,
        ]);
    }
}
