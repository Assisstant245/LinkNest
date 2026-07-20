<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Pages</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ auth()->user()->isPro() ? 'Pro plan — unlimited pages.' : 'Free plan — 1 page. Upgrade for more.' }}
            </p>
        </div>

        <button
            type="button"
            wire:click="createPage"
            class="inline-flex items-center gap-1.5 rounded-lg bg-gradient-to-b from-indigo-500 to-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm shadow-indigo-500/30 hover:from-indigo-400 hover:to-indigo-600 transition-colors"
        >
            <x-ui.icon name="plus" class="w-4 h-4" />
            Create new page
        </button>
    </div>

    @if (session('upgrade-required'))
        <div class="mt-4 flex items-center justify-between gap-4 rounded-xl border border-amber-200 bg-amber-50 dark:bg-amber-500/10 dark:border-amber-500/30 px-4 py-3">
            <p class="text-sm text-amber-800 dark:text-amber-300">{{ session('upgrade-required') }}</p>
            <a href="{{ route('billing') }}" class="shrink-0 text-sm font-semibold text-amber-900 dark:text-amber-200 hover:underline">Upgrade to Pro</a>
        </div>
    @endif

    <div class="mt-6 space-y-3">
        @forelse($pages as $page)
            <div class="flex items-center justify-between gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 px-5 py-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $page->profile_name }}</p>
                        @if($page->isPublished())
                            <span class="text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">Published</span>
                        @else
                            <span class="text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500">Draft</span>
                        @endif
                    </div>
                    @if($page->slug)
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 truncate">{{ $page->publicUrl() }}</p>
                    @endif

                    <div class="mt-2 flex items-center gap-2">
                        @if(auth()->user()->isPro())
                            <input
                                type="text"
                                wire:model.blur="domainDrafts.{{ $page->id }}"
                                placeholder="yourdomain.com"
                                class="w-48 rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-2 py-1 text-xs text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300"
                            >
                            <button
                                type="button"
                                wire:click="setCustomDomain({{ $page->id }}, domainDrafts.{{ $page->id }})"
                                class="text-xs font-medium text-indigo-600 hover:underline"
                            >
                                Save domain
                            </button>
                        @else
                            <input type="text" disabled placeholder="Custom domain — Pro only" class="w-48 rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 px-2 py-1 text-xs text-gray-400">
                            <a href="{{ route('billing') }}" class="text-xs font-medium text-amber-600 hover:underline">Upgrade</a>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" wire:click="editPage({{ $page->id }})" class="text-xs font-semibold rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 px-3 py-2 hover:border-indigo-300 transition-colors">
                        Edit
                    </button>
                    <button
                        type="button"
                        wire:click="deletePage({{ $page->id }})"
                        wire:confirm="Delete this page? This can't be undone."
                        class="text-xs font-semibold rounded-lg border border-red-200 dark:border-red-500/30 text-red-600 dark:text-red-400 px-3 py-2 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors"
                    >
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center text-sm text-gray-400 py-16 border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-2xl">
                No pages yet — create your first one to get started.
            </div>
        @endforelse
    </div>
</div>
