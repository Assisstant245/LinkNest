                @php
$isPro = auth()->user()->isPro();
@endphp

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Billing</h1>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upgrade to Pro to unlock custom domains, advanced themes, analytics, and remove LinkForge branding.</p>

    @if (session('status'))
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 dark:bg-emerald-500/10 dark:border-emerald-500/30 px-4 py-3 text-sm text-emerald-800 dark:text-emerald-300">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 grid sm:grid-cols-2 gap-4">
        <div class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-6">
            <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Free</h2>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">$0<span class="text-sm font-normal text-gray-400">/mo</span></p>
            <ul class="mt-4 space-y-2 text-sm text-gray-600 dark:text-gray-400">
                <li>1 page</li>
                <li>Standard theme presets</li>
                <li>"Made with LinkForge" badge</li>
            </ul>
            @if(! $isPro)
                <span class="mt-6 inline-flex items-center justify-center w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm font-medium text-gray-500">Current plan</span>
            @endif
        </div>

        <div class="rounded-2xl border-2 border-indigo-500 bg-white dark:bg-gray-900 p-6 relative">
            <span class="absolute -top-3 left-6 text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full bg-indigo-500 text-white">Pro</span>
            <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Pro</h2>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">Upgrade<span class="text-sm font-normal text-gray-400"> · billed monthly</span></p>
            <ul class="mt-4 space-y-2 text-sm text-gray-600 dark:text-gray-400">
                <li>Unlimited pages</li>
                <li>Custom domain</li>
                <li>Advanced theme presets</li>
                <li>Analytics dashboard</li>
                <li>No branding</li>
            </ul>

            @if($isPro)
                <span class="mt-6 inline-flex items-center justify-center w-full rounded-lg bg-indigo-50 dark:bg-indigo-500/10 px-4 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400">You're on Pro</span>
            @else
                <button
                    type="button"
                    wire:click="upgrade"
                    wire:loading.attr="disabled"
                    class="mt-6 inline-flex items-center justify-center w-full rounded-lg bg-gradient-to-b from-indigo-500 to-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm shadow-indigo-500/30 hover:from-indigo-400 hover:to-indigo-600 transition-colors disabled:opacity-60"
                >
                    <span wire:loading.remove>Upgrade to Pro</span>
                    <span wire:loading>Redirecting to checkout…</span>
                </button>
            @endif
        </div>
    </div>
</div>
