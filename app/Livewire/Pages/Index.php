<?php

namespace App\Livewire\Pages;

use App\Support\ThemePresets;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'My Pages'])]
class Index extends Component
{
    public array $domainDrafts = [];

    public function mount(): void
    {
        $this->domainDrafts = auth()->user()->pages()->pluck('custom_domain', 'id')->all();
    }

    public function createPage()
    {
        if (! auth()->user()->canCreateAnotherPage()) {
            session()->flash('upgrade-required', 'The free plan is limited to 1 page. Upgrade to Pro to create more.');

            return;
        }

        $page = auth()->user()->pages()->create([
            'profile_name' => auth()->user()->name,
            'profile_bio' => '',
            'theme' => ThemePresets::default(),
            'slug' => Str::slug(auth()->user()->name).'-'.Str::lower(Str::random(5)),
        ]);

        session(['builder.page_id' => $page->id]);

        return redirect()->route('builder');
    }

    public function editPage(int $id)
    {
        $page = auth()->user()->pages()->findOrFail($id);

        session(['builder.page_id' => $page->id]);

        return redirect()->route('builder');
    }

    public function deletePage(int $id): void
    {
        $page = auth()->user()->pages()->findOrFail($id);

        if (session('builder.page_id') === $page->id) {
            session()->forget('builder.page_id');
        }

        $page->delete();
    }

    public function setCustomDomain(int $id, ?string $domain = null): void
    {
        if (! auth()->user()->isPro()) {
            session()->flash('upgrade-required', 'Custom domains are a Pro feature. Upgrade to set one.');

            return;
        }

        $page = auth()->user()->pages()->findOrFail($id);
        $page->custom_domain = trim((string) $domain) ?: null;
        $page->save();

        $this->domainDrafts[$id] = $page->custom_domain;
    }

    public function render()
    {
        return view('livewire.pages.index', [
            'pages' => auth()->user()->pages()->latest()->get(),
        ]);
    }
}
