<?php

namespace App\Livewire\Builder;

use App\Jobs\ProcessProfileImage;
use App\Models\Link;
use App\Models\Page;
use App\Support\IconLibrary;
use App\Support\ImageProcessor;
use App\Support\TemplateCatalog;       
use App\Support\ThemePresets;
use App\Support\VideoProcessor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use RuntimeException;
use Illuminate\Support\Facades\Auth;


#[Layout('components.layouts.builder', ['title' => 'Builder'])]
class Editor extends Component
{
    use WithFileUploads;

    public array $blocks = [];

    public ?string $selectedBlockId = null;

    public array $socialLinks = [];

    public ?string $selectedSocialLinkId = null;

    public string $profileName = '';

    public string $profileBio = '';

    public array $theme = [];

    public ?string $activePresetSlug = null;

    public ?string $upgradeNotice = null;

    public ?string $profilePhotoPath = null;

    public $profilePhotoUpload = null;

    public ?string $pendingProfilePhotoUrl = null;

    public bool $profilePhotoProcessing = false;

    public ?string $coverPhotoPath = null;

    public $coverPhotoUpload = null;

    public $backgroundImageUpload = null;

    public $blockImageUpload = null;

    public $blockVideoUpload = null;

    public $productImageUpload = null;

    public string $iconSearch = '';

    public string $leftTab = 'link';

    public string $device = 'mobile';

    #[Locked]
    public ?int $pageId = null;

    public ?string $lastSavedAt = null;

    public array $availableNetworks = [];

    public string $slug = '';

    public bool $isPublished = false;

    public ?string $publicUrl = null;

    /**
     * All of these are now runtime inputs, supplied by whatever renders
     * <livewire:builder.editor ... /> (a Blade view, a controller, a route,
     * an API payload, etc). Nothing about a specific user/profile is
     * hardcoded in the component anymore — mount() just wires up what it's
     * given and falls back to empty/neutral state if nothing is passed.
     *
     * Example usage from a Blade view:
     *
     * <livewire:builder.editor
     *     :page-id="$page?->id"
     *     :profile-name="$page->profile_name ?? auth()->user()->name"
     *     :profile-bio="$page->profile_bio ?? ''"
     *     :theme="$page->theme ?? null"
     *     :social-links="$page->social_links ?? []"
     *     :available-networks="config('builder.social_networks')"
     *     :initial-blocks="$initialBlocks ?? null"
     * />
     */
    public function mount(
        ?int $pageId = null,
        ?string $profileName = null,
        ?string $profileBio = null,
        ?array $theme = null,
        ?array $socialLinks = null,
        ?array $availableNetworks = null,
        ?array $initialBlocks = null,
    ): void {
        $this->availableNetworks = $availableNetworks ?? config('builder.social_networks', []);
        $this->theme = $theme ?? ThemePresets::default();

        // 1. Explicit pageId passed in from the frontend takes priority.
        $page = $pageId ? Page::with('links')->where('user_id', Auth::id())->find($pageId) : null;

        // 2. Otherwise, fall back to whatever the session already had.
        if (! $page) {
    $existingPageId = session('builder.page_id');

    if ($existingPageId) {
        $page = Page::with('links')
            ->where('user_id', Auth::id())
            ->find($existingPageId);
    }

    if (! $page) {
        $page = Page::with('links')
            ->where('user_id', Auth::id())
            ->latest()
            ->first();
    }
}

        if ($page) {
            $this->loadFromPage($page);
        }

        // 3. A template selected on the frontend (e.g. "start from this template")
        //    can still override the loaded page, same as before.
        $templateSlug = session()->pull('applyTemplateSlug');
        $template = $templateSlug ? TemplateCatalog::find($templateSlug) : null;

        if ($template) {
            $this->profileName = $template['profileName'];
            $this->profileBio = $template['profileBio'];
            $this->blocks = $template['blocks'];
        }

        // 4. Anything explicitly passed as a component parameter wins over
        //    session/page/template data — the frontend is the source of truth
        //    for what it explicitly sends.
        if ($profileName !== null) {
            $this->profileName = $profileName;
        }

        if ($profileBio !== null) {
            $this->profileBio = $profileBio;
        }

        if ($socialLinks !== null) {
            $this->socialLinks = $socialLinks;
        } elseif (empty($this->socialLinks)) {
            $this->socialLinks = array_map(
                fn (string $network) => $this->makeSocialLink($network),
                $this->availableNetworks
            );
        }

        if ($initialBlocks !== null) {
            $this->blocks = $initialBlocks;
        }
    }

    protected function loadFromPage(Page $page): void
    {
        $this->pageId = $page->id;
        $this->profileName = $page->profile_name;
        $this->profileBio = $page->profile_bio ?? '';
        $this->theme = $page->theme ?: $this->theme;
        $this->socialLinks = $page->social_links ?: $this->socialLinks;
        $this->lastSavedAt = $page->updated_at?->diffForHumans();

        $this->blocks = $page->links->map(fn (Link $link) => [
            'id' => $link->uuid,
            'type' => $link->type,
            'data' => $link->data ?? [],
        ])->all();

        $this->slug = $page->slug ?? '';
        $this->isPublished = $page->isPublished();
        $this->publicUrl = $page->slug ? $page->publicUrl() : null;
        $this->profilePhotoPath = $page->profile_photo_path;
        $this->coverPhotoPath = $page->cover_photo_path;
    }

    /**
     * Livewire calls this automatically whenever socialLinks changes via a
     * wire:model binding. A stale array-index binding (e.g. the URL field's
     * socialLinks.{index}.url, captured before a removal shifted indices)
     * can auto-vivify a bogus entry with neither an id nor a network —
     * strip those out immediately so they never reach save() or a render.
     */
    public function updatedSocialLinks(): void
    {
        $this->socialLinks = $this->sanitizedSocialLinks();
    }

    protected function sanitizedSocialLinks(): array
    {
        return collect($this->socialLinks)
            ->filter(fn ($link) => isset($link['id'], $link['network']))
            ->values()
            ->all();
    }

    public function save(): void
    {
        if (! $this->pageId && ! auth()->user()->canCreateAnotherPage()) {
            $this->redirect(route('billing'), navigate: true);

            return;
        }

        $page = $this->pageId
            ? Page::where('user_id', Auth::id())->findOrFail($this->pageId)
            : new Page(['user_id' => Auth::id()]);

        // Capture what's currently persisted before it's overwritten, so any
        // image that's no longer referenced after this save can be cleaned up
        // safely — never delete a file before the state that stops pointing
        // at it has actually been saved.
        $oldProfilePhotoPath = $page->profile_photo_path;
        $oldCoverPhotoPath = $page->cover_photo_path;
        $oldBackground = $page->theme['background'] ?? [];
        $oldBackgroundPath = ($oldBackground['type'] ?? null) === 'image' ? ($oldBackground['path'] ?? null) : null;
        $oldLinkImagePaths = $page->exists
            ? $page->links()->pluck('data', 'uuid')->map(fn ($data) => $data['path'] ?? null)->filter()->all()
            : [];

        $page->fill([
            'profile_name' => $this->profileName,
            'profile_bio' => $this->profileBio,
            'profile_photo_path' => $this->profilePhotoPath,
            'cover_photo_path' => $this->coverPhotoPath,
            'theme' => $this->theme,
            'social_links' => $this->sanitizedSocialLinks(),
        ]);
        $page->save();

        $this->pageId = $page->id;
        session(['builder.page_id' => $page->id]);

        $currentUuids = collect($this->blocks)->pluck('id')->all();
        $page->links()->whereNotIn('uuid', $currentUuids)->delete();

        foreach ($this->blocks as $position => $block) {
            $page->links()->updateOrCreate(
                ['uuid' => $block['id']],
                [
                    'type' => $block['type'],
                    'data' => $block['data'],
                    'position' => $position,
                ]
            );
        }

        if ($oldProfilePhotoPath && $oldProfilePhotoPath !== $this->profilePhotoPath) {
            ImageProcessor::delete($oldProfilePhotoPath);
        }

        if ($oldCoverPhotoPath && $oldCoverPhotoPath !== $this->coverPhotoPath) {
            ImageProcessor::delete($oldCoverPhotoPath);
        }

        $newBackgroundPath = ($this->theme['background']['type'] ?? null) === 'image'
            ? ($this->theme['background']['path'] ?? null)
            : null;

        if ($oldBackgroundPath && $oldBackgroundPath !== $newBackgroundPath) {
            ImageProcessor::delete($oldBackgroundPath);
        }

        $newLinkImagePaths = collect($this->blocks)->pluck('data.path')->filter()->all();

        foreach ($oldLinkImagePaths as $oldPath) {
            if (! in_array($oldPath, $newLinkImagePaths, true)) {
                ImageProcessor::delete($oldPath);
            }
        }

        $this->lastSavedAt = now()->diffForHumans();

        if ($page->slug) {
            Cache::forget("public-page:{$page->slug}");
        }
    }

    public function publish(): void
    {
        $this->save(); // reuse existing save() to persist current state first

        $page = Page::where('user_id', Auth::id())->findOrFail($this->pageId);

        if (! $page->slug) {
            $page->slug = $this->generateUniqueSlug($this->profileName);
        }

        $page->published_at = now();
        $page->save();

        $this->slug = $page->slug;
        $this->isPublished = true;
        $this->publicUrl = $page->publicUrl();

        Cache::forget("public-page:{$page->slug}");
    }

    protected function generateUniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'page';
        $slug = $base;
        $i = 1;

        while (Page::where('slug', $slug)->where('id', '!=', $this->pageId)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    public function applyPreset(string $slug): void
    {
        $preset = ThemePresets::find($slug);

        if ($preset === null) {
            return;
        }

        if ($preset['pro'] && ! auth()->user()->isPro()) {
            $this->upgradeNotice = "\"{$preset['name']}\" is a Pro preset. Upgrade to use it.";

            return;
        }

        $this->upgradeNotice = null;
        $this->theme = $preset['tokens'];
        $this->activePresetSlug = $slug;
    }

    public function updatedProfilePhotoUpload(): void
    {
        $this->validate(['profilePhotoUpload' => 'image|max:5120|mimes:jpg,jpeg,png,webp,gif']);

        if (! $this->pageId) {
            // Page isn't persisted yet — there's no row for a background job
            // to attach to, so process inline exactly as before.
            try {
                $this->profilePhotoPath = ImageProcessor::profilePhoto($this->profilePhotoUpload);
            } catch (RuntimeException) {
                $this->addError('profilePhotoUpload', 'That image could not be processed. Try a different file.');

                return;
            }

            $this->profilePhotoUpload = null;

            return;
        }

        $this->pendingProfilePhotoUrl = $this->profilePhotoUpload->temporaryUrl();
        $tempPath = $this->profilePhotoUpload->store('profile-uploads-pending', 'local');

        ProcessProfileImage::dispatch(Page::findOrFail($this->pageId), $tempPath);

        $this->profilePhotoProcessing = true;
        $this->profilePhotoUpload = null;
    }

    public function pollProfilePhotoStatus(): void
    {
        if (! $this->profilePhotoProcessing || ! $this->pageId) {
            return;
        }

        $current = Page::find($this->pageId)?->profile_photo_path;

        if ($current && $current !== $this->profilePhotoPath) {
            $this->profilePhotoPath = $current;
            $this->profilePhotoProcessing = false;
            $this->pendingProfilePhotoUrl = null;
        }
    }

    public function removeProfilePhoto(): void
    {
        $this->profilePhotoPath = null;
        $this->pendingProfilePhotoUrl = null;
        $this->profilePhotoProcessing = false;
    }

    public function updatedCoverPhotoUpload(): void
    {
        $this->validate(['coverPhotoUpload' => 'image|max:5120|mimes:jpg,jpeg,png,webp,gif']);

        try {
            $this->coverPhotoPath = ImageProcessor::coverPhoto($this->coverPhotoUpload);
        } catch (RuntimeException) {
            $this->addError('coverPhotoUpload', 'That image could not be processed. Try a different file.');

            return;
        }

        $this->coverPhotoUpload = null;
    }

    public function removeCoverPhoto(): void
    {
        $this->coverPhotoPath = null;
    }

    public function updatedBackgroundImageUpload(): void
    {
        $this->validate(['backgroundImageUpload' => 'image|max:5120|mimes:jpg,jpeg,png,webp,gif']);

        try {
            $path = ImageProcessor::backgroundImage($this->backgroundImageUpload);
        } catch (RuntimeException) {
            $this->addError('backgroundImageUpload', 'That image could not be processed. Try a different file.');

            return;
        }

        $this->theme['background'] = ['type' => 'image', 'path' => $path];
        $this->backgroundImageUpload = null;
    }

    public function removeBackgroundImage(): void
    {
        $this->theme['background'] = ['type' => 'solid', 'value' => '#f8fafc'];
    }

    public function updatedBlockImageUpload(): void
    {
        $index = $this->selectedBlockId ? $this->indexOf($this->selectedBlockId) : null;

        if ($index === null) {
            return;
        }

        $this->validate(['blockImageUpload' => 'image|max:5120|mimes:jpg,jpeg,png,webp,gif']);

        try {
            $path = ImageProcessor::blockImage($this->blockImageUpload);
        } catch (RuntimeException) {
            $this->addError('blockImageUpload', 'That image could not be processed. Try a different file.');

            return;
        }

        $this->blocks[$index]['data']['path'] = $path;
        $this->blockImageUpload = null;
    }

    public function removeBlockImage(string $id): void
    {
        $index = $this->indexOf($id);

        if ($index === null) {
            return;
        }

        unset($this->blocks[$index]['data']['path']);
    }

    public function updatedProductImageUpload(): void
    {
        $index = $this->selectedBlockId ? $this->indexOf($this->selectedBlockId) : null;

        if ($index === null) {
            return;
        }

        $this->validate(['productImageUpload' => 'image|max:5120|mimes:jpg,jpeg,png,webp,gif']);

        try {
            $path = ImageProcessor::productImage($this->productImageUpload);
        } catch (RuntimeException) {
            $this->addError('productImageUpload', 'That image could not be processed. Try a different file.');

            return;
        }

        $this->blocks[$index]['data']['path'] = $path;
        $this->productImageUpload = null;
    }

    public function removeProductImage(string $id): void
    {
        $index = $this->indexOf($id);

        if ($index === null) {
            return;
        }

        unset($this->blocks[$index]['data']['path']);
    }

    public function updatedBlockVideoUpload(): void
    {
        $index = $this->selectedBlockId ? $this->indexOf($this->selectedBlockId) : null;

        if ($index === null) {
            return;
        }

        $this->validate(['blockVideoUpload' => 'file|max:40960|mimes:mp4,mov,webm,ogg']);

        $path = VideoProcessor::store($this->blockVideoUpload);

        $this->blocks[$index]['data']['path'] = $path;
        $this->blocks[$index]['data']['url'] = null;
        $this->blockVideoUpload = null;
    }

    public function removeBlockVideo(string $id): void
    {
        $index = $this->indexOf($id);

        if ($index === null) {
            return;
        }

        unset($this->blocks[$index]['data']['path']);
    }

    public function setLeftTab(string $tab): void
    {
        $this->leftTab = $tab;
    }

    public function setDevice(string $device): void
    {
        $this->device = $device;
    }

    public function switchPage(int $id)
    {
        $page = Auth::user()->pages()->findOrFail($id);

        session(['builder.page_id' => $page->id]);

        return $this->redirect(route('builder'), navigate: true);
    }

    public function addBlockAt(string $type, int $index): void
    {
        $block = $this->makeBlock($type);

        $index = max(0, min($index, count($this->blocks)));

        array_splice($this->blocks, $index, 0, [$block]);

        $this->selectedBlockId = $block['id'];
    }

    public function selectBlock(string $id): void
    {
        $this->selectedBlockId = $id;
        $this->selectedSocialLinkId = null;
    }

    public function deselectBlock(): void
    {
        $this->selectedBlockId = null;
    }

    public function selectSocialLink(string $id): void
    {
        $this->selectedSocialLinkId = $id;
        $this->selectedBlockId = null;
    }

    public function deselectSocialLink(): void
    {
        $this->selectedSocialLinkId = null;
    }

    public function deselectAll(): void
    {
        $this->selectedBlockId = null;
        $this->selectedSocialLinkId = null;
    }

    public function addSocialLink(string $network): void
    {
        if (collect($this->socialLinks)->contains('network', $network)) {
            return;
        }

        $link = $this->makeSocialLink($network);

        $this->socialLinks[] = $link;
        $this->selectedSocialLinkId = $link['id'];
        $this->selectedBlockId = null;
    }

    public function removeSocialLink(string $id): void
    {
        $this->socialLinks = array_values(array_filter($this->socialLinks, fn ($link) => $link['id'] !== $id));

        if ($this->selectedSocialLinkId === $id) {
            $this->selectedSocialLinkId = null;
        }
    }

    public function deleteBlock(string $id): void
    {
        $this->blocks = array_values(array_filter($this->blocks, fn ($block) => $block['id'] !== $id));

        if ($this->selectedBlockId === $id) {
            $this->selectedBlockId = null;
        }
    }

    public function duplicateBlock(string $id): void
    {
        $index = $this->indexOf($id);

        if ($index === null) {
            return;
        }

        $copy = $this->blocks[$index];
        $copy['id'] = (string) Str::uuid();

        array_splice($this->blocks, $index + 1, 0, [$copy]);

        $this->selectedBlockId = $copy['id'];
    }

    public function toggleSocialNetwork(string $id, string $network): void
    {
        $index = $this->indexOf($id);

        if ($index === null) {
            return;
        }

        $networks = $this->blocks[$index]['data']['networks'] ?? [];

        $this->blocks[$index]['data']['networks'] = in_array($network, $networks, true)
            ? array_values(array_diff($networks, [$network]))
            : [...$networks, $network];
    }

    public function setBlockIcon(string $id, ?string $icon): void
    {
        $index = $this->indexOf($id);

        if ($index === null) {
            return;
        }

        $this->blocks[$index]['data']['icon'] = $icon;
        $this->iconSearch = '';
    }

    public function reorder(array $orderedIds): void
    {
        $byId = collect($this->blocks)->keyBy('id');

        $this->blocks = collect($orderedIds)
            ->map(fn ($id) => $byId->get($id))
            ->filter()
            ->values()
            ->all();
    }

    protected function indexOf(string $id): ?int
    {
        foreach ($this->blocks as $index => $block) {
            if ($block['id'] === $id) {
                return $index;
            }
        }

        return null;
    }

    protected function indexOfSocialLink(string $id): ?int
    {
        foreach ($this->socialLinks as $index => $link) {
            if ($link['id'] === $id) {
                return $index;
            }
        }

        return null;
    }

    protected function makeSocialLink(string $network, string $url = ''): array
    {
        return [
            'id' => (string) Str::uuid(),
            'network' => $network,
            'url' => $url,
        ];
    }

    protected function makeBlock(string $type, array $data = []): array
    {
        return [
            'id' => (string) Str::uuid(),
            'type' => $type,
            'data' => array_merge($this->defaultDataFor($type), $data),
        ];
    }

    protected function defaultDataFor(string $type): array
    {
        return match ($type) {
            'heading' => ['text' => 'Heading'],
            'text' => ['text' => 'Add your text here…'],
            'button' => ['label' => 'New link', 'url' => '', 'subtitle' => null, 'icon' => 'link', 'variant' => $this->theme['buttons']['style'] ?? 'filled', 'thumbnail' => false, 'featured' => false],
            'social' => ['networks' => $this->availableNetworks],
            'divider' => [],
            'spacer' => ['height' => 24],
            'video' => ['url' => null, 'path' => null],
            'contact' => ['email' => null, 'phone' => null],
            'product' => ['name' => 'New product', 'description' => '', 'price' => null, 'path' => null, 'url' => ''],
            'image' => [],
            default => [],
        };
    }
    

    public function render()
    {
        // Belt-and-suspenders: guard the render pass itself against any
        // malformed entry too, even though updatedSocialLinks() and save()
        // are the places that actually keep this from persisting.
        $this->socialLinks = $this->sanitizedSocialLinks();

        $selectedIndex = $this->selectedBlockId ? $this->indexOf($this->selectedBlockId) : null;
        $selectedSocialIndex = $this->selectedSocialLinkId ? $this->indexOfSocialLink($this->selectedSocialLinkId) : null;

        return view('livewire.builder.editor', [
            'selectedBlock' => $selectedIndex !== null ? $this->blocks[$selectedIndex] : null,
            'selectedIndex' => $selectedIndex,
            'selectedSocialLink' => $selectedSocialIndex !== null ? $this->socialLinks[$selectedSocialIndex] : null,
            'selectedSocialIndex' => $selectedSocialIndex,
            'availableSocialNetworks' => collect($this->availableNetworks)
                ->diff(collect($this->socialLinks)->pluck('network'))
                ->values()
                ->all(),
            'themePresets' => ThemePresets::all(),
            'userPages' => auth()->user()->pages()->get(['id', 'profile_name']),
            'profilePhotoUrl' => $this->pendingProfilePhotoUrl ?? ImageProcessor::url($this->profilePhotoPath),
            'profilePhotoProcessing' => $this->profilePhotoProcessing,
            'coverPhotoUrl' => ImageProcessor::url($this->coverPhotoPath),
            'filteredIcons' => IconLibrary::search($this->iconSearch),
        ]);
    }
}