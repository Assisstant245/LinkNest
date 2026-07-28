<?php

namespace App\Livewire\Templates;

use App\Support\TemplateCatalog;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Templates'])]
class Gallery extends Component
{
    public string $search = '';

    public string $activeCategory = 'all';

    public string $viewMode = 'grid';

    public ?string $selectedSlug = null;

    public ?string $upgradeNotice = null;

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = $mode;
    }

    public function selectTemplate(string $slug): void
    {
        $this->selectedSlug = $this->selectedSlug === $slug ? null : $slug;
    }

    public function closePreview(): void
    {
        $this->selectedSlug = null;
    }

    public function applyTemplate(string $slug)
    {
        $template = TemplateCatalog::find($slug);

        if (($template['pro'] ?? false) && ! auth()->user()->isPro()) {
            $this->upgradeNotice = "\"{$template['name']}\" is a Pro template. Upgrade to use it.";

            return;
        }

        $this->upgradeNotice = null;

        session(['applyTemplateSlug' => $slug]);

        return redirect()->route('builder');
    }

    public function render()
    {
        $search = trim(strtolower($this->search));

        $templates = collect(TemplateCatalog::all())
            ->when($this->activeCategory !== 'all', function ($templates) {
                return $templates->filter(fn ($template) => strtolower($template['category']) === $this->activeCategory);
            })
            ->when($search !== '', function ($templates) use ($search) {
                return $templates->filter(function ($template) use ($search) {
                    return str_contains(strtolower($template['name']), $search)
                        || str_contains(strtolower($template['description']), $search);
                });
            })
            ->values();

        return view('livewire.templates.gallery', [
            'templates' => $templates,
            'selectedTemplate' => $this->selectedSlug ? TemplateCatalog::find($this->selectedSlug) : null,
            'isPro' => auth()->user()->isPro(),
        ]);
    }
}
