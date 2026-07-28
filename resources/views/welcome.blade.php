<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LinkNest — One link for everything you create</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full bg-gray-50 font-sans antialiased text-gray-900">

    <div class="h-1 bg-gradient-to-r from-indigo-500 via-violet-500 to-pink-500"></div>
    <header class="h-16 border-b border-gray-200 bg-white/95 backdrop-blur sticky top-0 z-30">
        <livewire:welcome.navigation />
    </header>

    <main class="overflow-x-hidden">
        {{-- Hero --}}
        <section class="relative overflow-hidden">
            {{-- Colorful mesh background --}}
            <div class="absolute inset-0 -z-10 bg-gradient-to-b from-indigo-50/70 via-white to-white"></div>
            <div class="absolute -z-10 -top-24 -left-24 w-[420px] h-[420px] rounded-full bg-gradient-to-br from-indigo-300 to-violet-400 blur-3xl opacity-30"></div>
            <div class="absolute -z-10 top-10 right-0 w-[380px] h-[380px] rounded-full bg-gradient-to-br from-pink-300 to-rose-300 blur-3xl opacity-30"></div>
            <div class="absolute -z-10 bottom-0 left-1/3 w-[320px] h-[320px] rounded-full bg-gradient-to-br from-amber-200 to-orange-300 blur-3xl opacity-25"></div>
            <div class="absolute inset-0 -z-10 opacity-[0.15]" style="background-image: radial-gradient(circle, #6366f1 1px, transparent 1px); background-size: 28px 28px;"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-14 pb-20 sm:pt-20 sm:pb-28 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-gradient-to-r from-indigo-500 via-violet-500 to-pink-500 rounded-full px-3 py-1.5 shadow-md shadow-indigo-500/30">
                    <x-ui.icon name="rocket" class="w-3.5 h-3.5" />
                    Link-in-bio, made simple
                </span>

                <h1 class="mt-5 text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 leading-[1.1]">
                    One link for <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-pink-600 bg-clip-text text-transparent">everything</span> you create
                </h1>

                <p class="mt-5 text-base sm:text-lg text-gray-500 leading-relaxed max-w-md">
                    Build a mobile-friendly page for all your links. Pick a template, add buttons and social icons, connect a custom domain, and share a single URL everywhere.
                </p>

                <form action="{{ route('register') }}" class="mt-8 flex flex-col sm:flex-row items-stretch gap-2.5 max-w-md">
                    <div class="flex-1 flex items-center rounded-lg border border-gray-200 bg-white pl-3 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500/30 focus-within:border-indigo-300">
                        <span class="text-sm text-gray-400 whitespace-nowrap">linknest.test/</span>
                        <input type="text" name="handle" placeholder="yourname" class="w-full border-0 bg-transparent px-1 py-2.5 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-0">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-1.5 font-medium rounded-lg transition-colors duration-150 whitespace-nowrap text-sm px-5 py-2.5 bg-gradient-to-b from-indigo-500 to-indigo-600 text-white shadow-sm shadow-indigo-500/30 hover:from-indigo-400 hover:to-indigo-600 border border-indigo-600/50">
                        Get Started
                        <x-ui.icon name="chevron-down" class="w-3.5 h-3.5 -rotate-90" />
                    </button>
                </form>

                <p class="mt-3 text-xs text-gray-400">Free to start · No credit card required</p>

                <div class="mt-10 flex items-center gap-6">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">12k+</p>
                        <p class="text-xs text-gray-400">Pages published</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">4.9/5</p>
                        <p class="text-xs text-gray-400">Creator rating</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">99.9%</p>
                        <p class="text-xs text-gray-400">Uptime</p>
                    </div>
                </div>
            </div>

            {{-- Phone mockup with floating decorative cards --}}
            <div class="relative flex justify-center lg:justify-end py-6">
                <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[420px] h-[420px] rounded-full bg-gradient-to-br from-indigo-100 via-violet-100 to-pink-100 blur-3xl opacity-70"></div>

                <div class="relative">
                    <x-builder.device-preview device="mobile" :theme="[]">
                        <x-builder.profile-preview
                            name="@yourname"
                            bio="Creator & photographer ✦ New drop every Friday"
                            :social-links="[
                                ['id' => '1', 'network' => 'instagram'],
                                ['id' => '2', 'network' => 'youtube'],
                                ['id' => '3', 'network' => 'mail'],
                            ]"
                            :editable="false"
                        />
                        <div class="space-y-3 px-5 pb-6">
                            <x-builder.link-button label="Watch my latest video" icon="lucide:play" variant="filled" />
                            <x-builder.link-button label="Shop my favorites" icon="link" variant="soft" />
                            <x-builder.link-button label="Book a session" icon="mail" variant="outline" :featured="true" />
                        </div>
                    </x-builder.device-preview>

                    <div class="hidden sm:flex absolute -left-16 top-16 items-center gap-2.5 bg-white/90 backdrop-blur rounded-2xl shadow-xl shadow-emerald-500/10 border border-emerald-100 px-3.5 py-3 -rotate-6 hover:rotate-0 transition-transform duration-200">
                        <span class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white shadow-sm shadow-emerald-500/30">
                            <x-ui.icon name="check" class="w-4 h-4" />
                        </span>
                        <div>
                            <p class="text-xs font-semibold text-gray-900">Published</p>
                            <p class="text-[11px] text-gray-400">linknest.test/yourname</p>
                        </div>
                    </div>

                    <div class="hidden sm:flex absolute -right-12 top-48 items-center gap-2.5 bg-white/90 backdrop-blur rounded-2xl shadow-xl shadow-indigo-500/10 border border-indigo-100 px-3.5 py-3 rotate-3 hover:rotate-0 transition-transform duration-200">
                        <span class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white shadow-sm shadow-indigo-500/30">
                            <x-ui.icon name="lucide:trending-up" class="w-4 h-4" />
                        </span>
                        <div>
                            <p class="text-xs font-semibold text-gray-900">1,204 clicks</p>
                            <p class="text-[11px] text-gray-400">this week</p>
                        </div>
                    </div>

                    <div class="hidden sm:flex absolute -left-10 bottom-16 items-center gap-2.5 bg-white/90 backdrop-blur rounded-2xl shadow-xl shadow-pink-500/10 border border-pink-100 px-3.5 py-3 rotate-6 hover:rotate-0 transition-transform duration-200">
                        <span class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white shadow-sm shadow-pink-500/30">
                            <x-ui.icon name="instagram" class="w-4 h-4" />
                        </span>
                        <div>
                            <p class="text-xs font-semibold text-gray-900">+248 followers</p>
                            <p class="text-[11px] text-gray-400">from this page</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        {{-- Social proof --}}
        <section class="border-y border-gray-100 bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Trusted by creators & small businesses everywhere</p>
                <div class="mt-5 flex items-center justify-center -space-x-3">
                    @foreach ([
                        ['initials' => 'JW', 'from' => 'from-indigo-400', 'to' => 'to-violet-500'],
                        ['initials' => 'BS', 'from' => 'from-pink-400', 'to' => 'to-rose-500'],
                        ['initials' => 'MH', 'from' => 'from-amber-400', 'to' => 'to-orange-500'],
                        ['initials' => 'JC', 'from' => 'from-emerald-400', 'to' => 'to-teal-500'],
                        ['initials' => 'YK', 'from' => 'from-sky-400', 'to' => 'to-indigo-500'],
                        ['initials' => 'RP', 'from' => 'from-violet-400', 'to' => 'to-fuchsia-500'],
                    ] as $avatar)
                        <span class="w-10 h-10 rounded-full bg-gradient-to-br {{ $avatar['from'] }} {{ $avatar['to'] }} ring-2 ring-white flex items-center justify-center text-[11px] font-semibold text-white">
                            {{ $avatar['initials'] }}
                        </span>
                    @endforeach
                    <span class="w-10 h-10 rounded-full bg-gray-100 ring-2 ring-white flex items-center justify-center text-[11px] font-semibold text-gray-500">
                        +12k
                    </span>
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="max-w-7xl mx-auto px-4 sm:px-6 py-20 sm:py-28">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Everything you need in one page</h2>
                <p class="mt-3 text-gray-500">No-code tools built for creators, small businesses, and professionals who need one link that does it all.</p>
            </div>

            <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ([
                    ['icon' => 'button', 'title' => 'No-code builder', 'desc' => 'Drag-and-drop link buttons, reorder blocks, and preview everything live on a real mobile frame.'],
                    ['icon' => 'swatch', 'title' => 'Templates & theming', 'desc' => 'Start from a professionally designed template, then customize colors, fonts, and button styles.'],
                    ['icon' => 'video', 'title' => 'Rich blocks', 'desc' => 'Embed videos, add tap-to-contact email/phone buttons, and highlight your best links as Featured.'],
                    ['icon' => 'lucide:globe', 'title' => 'Custom domain', 'desc' => 'Connect your own domain for a fully branded link — no "linknest.test" in sight.'],
                    ['icon' => 'lucide:trending-up', 'title' => 'Analytics', 'desc' => 'Track views and clicks per link, see what\'s working, and understand where your traffic comes from.'],
                    ['icon' => 'social', 'title' => 'Social icons', 'desc' => 'A clean row of social icons — Instagram, TikTok, YouTube, WhatsApp, X, and more.'],
                ] as $feature)
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                        <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-sm shadow-indigo-500/30">
                            <x-builder.link-icon :name="$feature['icon']" class="w-5 h-5 text-white" />
                        </span>
                        <h3 class="mt-4 text-sm font-semibold text-gray-900">{{ $feature['title'] }}</h3>
                        <p class="mt-1.5 text-sm text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Showcase: customization + analytics --}}
        <section id="showcase" class="bg-white border-y border-gray-100 py-20 sm:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="max-w-xl mx-auto text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Make it yours, then watch it work</h2>
                    <p class="mt-3 text-gray-500">Customize every detail of your page, and see exactly how it performs.</p>
                </div>

                <div class="mt-12 grid lg:grid-cols-2 gap-6">
                    {{-- Customization card --}}
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 sm:p-8">
                        <h3 class="text-sm font-semibold text-gray-900">Design tokens, not guesswork</h3>
                        <p class="mt-1.5 text-sm text-gray-500">Colors, fonts, button shapes and backgrounds — tweak everything and see it update instantly.</p>

                        <div class="mt-6 bg-white rounded-xl border border-gray-200 p-4 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-500">Primary color</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-5 h-5 rounded-full ring-1 ring-black/10 bg-indigo-500"></span>
                                    <span class="w-5 h-5 rounded-full ring-1 ring-black/10 bg-violet-500"></span>
                                    <span class="w-5 h-5 rounded-full ring-1 ring-black/10 bg-pink-500 ring-2 ring-offset-1 ring-pink-400"></span>
                                    <span class="w-5 h-5 rounded-full ring-1 ring-black/10 bg-emerald-500"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-500">Button style</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[11px] font-medium rounded-full border border-indigo-500 bg-indigo-50 text-indigo-600 px-2.5 py-1">Filled</span>
                                    <span class="text-[11px] font-medium rounded-full border border-gray-200 text-gray-500 px-2.5 py-1">Soft</span>
                                    <span class="text-[11px] font-medium rounded-full border border-gray-200 text-gray-500 px-2.5 py-1">Outline</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-500">Corner radius</span>
                                <div class="flex-1 max-w-[140px] ml-4 h-1.5 rounded-full bg-gray-100 relative">
                                    <div class="absolute inset-y-0 left-0 w-2/3 rounded-full bg-indigo-500"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Analytics card --}}
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 sm:p-8">
                        <h3 class="text-sm font-semibold text-gray-900">Know what's working</h3>
                        <p class="mt-1.5 text-sm text-gray-500">Views, clicks, and top platforms — logged server-side for accurate, reliable stats.</p>

                        <div class="mt-6 bg-white rounded-xl border border-gray-200 p-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-lg bg-gray-50 p-3">
                                    <p class="text-[11px] text-gray-400">Total views</p>
                                    <p class="mt-0.5 text-lg font-bold text-gray-900">18,204</p>
                                </div>
                                <div class="rounded-lg bg-gray-50 p-3">
                                    <p class="text-[11px] text-gray-400">Total clicks</p>
                                    <p class="mt-0.5 text-lg font-bold text-gray-900">6,512</p>
                                </div>
                            </div>

                            <div class="mt-4 flex items-end gap-1.5 h-20">
                                @foreach ([40, 65, 50, 80, 55, 90, 70] as $height)
                                    <div class="flex-1 rounded-t-md bg-gradient-to-t from-indigo-500 to-violet-400" style="height: {{ $height }}%"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Pricing teaser --}}
        <section id="pricing" class="max-w-5xl mx-auto px-4 sm:px-6 py-20 sm:py-28">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Simple, honest pricing</h2>
                <p class="mt-3 text-gray-500">Start for free. Upgrade when you need custom domains, advanced themes, and analytics.</p>
            </div>

            <div class="mt-12 grid sm:grid-cols-2 gap-5 max-w-2xl mx-auto">
                <div class="rounded-2xl border border-gray-200 bg-white p-6">
                    <h3 class="text-sm font-semibold text-gray-900">Free</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-900">$0<span class="text-sm font-normal text-gray-400">/mo</span></p>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> 1 page</li>
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> Standard theme presets</li>
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> "Made with LinkNest" badge</li>
                    </ul>
                    <a href="{{ route('register') }}" class="mt-6 inline-flex items-center justify-center w-full rounded-lg border border-gray-200 text-gray-700 px-4 py-2 text-sm font-medium hover:border-gray-300 transition-colors">
                        Get started free
                    </a>
                </div>

                <div class="rounded-2xl border-2 border-indigo-500 bg-white p-6 relative">
                    <span class="absolute -top-3 left-6 text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full bg-indigo-500 text-white">Pro</span>
                    <h3 class="text-sm font-semibold text-gray-900">Pro</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-900">Upgrade<span class="text-sm font-normal text-gray-400"> · billed monthly</span></p>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> Unlimited pages</li>
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> Custom domain</li>
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> Advanced theme presets</li>
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> Analytics dashboard</li>
                        <li class="flex items-center gap-2"><x-ui.icon name="check" class="w-3.5 h-3.5 text-emerald-500 shrink-0" /> No branding</li>
                    </ul>
                    <a href="{{ route('register') }}" class="mt-6 inline-flex items-center justify-center w-full rounded-lg bg-gradient-to-b from-indigo-500 to-indigo-600 text-white px-4 py-2 text-sm font-medium shadow-sm shadow-indigo-500/30 hover:from-indigo-400 hover:to-indigo-600 transition-colors">
                        Upgrade to Pro
                    </a>
                </div>
            </div>
        </section>

        {{-- Final CTA --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-20 sm:pb-28">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-500 to-violet-600 px-6 py-14 sm:py-16 text-center">
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10"></div>
                <div class="absolute -left-8 -bottom-8 w-32 h-32 rounded-full bg-white/10"></div>

                <h2 class="text-2xl sm:text-3xl font-bold text-white">Ready to bring all your links together?</h2>
                <p class="mt-3 text-indigo-100 max-w-md mx-auto">Join thousands of creators and businesses sharing one simple link.</p>
                <a href="{{ route('register') }}" class="mt-7 inline-flex items-center justify-center gap-1.5 rounded-lg bg-white text-indigo-600 px-6 py-3 text-sm font-semibold shadow-lg hover:bg-indigo-50 transition-colors">
                    Get Started — It's Free
                </a>
            </div>
        </section>
    </main>

    <footer class="border-t border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-1">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-sm shadow-indigo-500/30">
                            <svg viewBox="0 0 24 24" class="w-4.5 h-4.5 text-white" fill="currentColor"><path d="M9.5 14.5 14.5 9.5M8 17l-2 2a3.5 3.5 0 0 1-5-5l3-3a3.5 3.5 0 0 1 5-.2M16 7l2-2a3.5 3.5 0 0 1 5 5l-3 3a3.5 3.5 0 0 1-5 .2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="font-semibold text-gray-900">LinkNest</span>
                    </a>
                    <p class="mt-3 text-sm text-gray-500 max-w-xs">One mobile-friendly page for all your links. Pick a template, add your links, and share a single URL everywhere.</p>

                    <div class="mt-4 flex items-center gap-2">
                        <a href="#" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:border-indigo-300 transition-colors">
                            <x-ui.icon name="instagram" class="w-3.5 h-3.5" />
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:border-indigo-300 transition-colors">
                            <x-ui.icon name="x-twitter" class="w-3.5 h-3.5" />
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:border-indigo-300 transition-colors">
                            <x-ui.icon name="youtube" class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-400">Product</h4>
                    <ul class="mt-3 space-y-2.5 text-sm">
                        <li><a href="#features" class="text-gray-500 hover:text-gray-900 transition-colors">Features</a></li>
                        <li><a href="#showcase" class="text-gray-500 hover:text-gray-900 transition-colors">Templates</a></li>
                        <li><a href="#pricing" class="text-gray-500 hover:text-gray-900 transition-colors">Pricing</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-400">Account</h4>
                    <ul class="mt-3 space-y-2.5 text-sm">
                        <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 transition-colors">Log in</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-900 transition-colors">Sign up</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-400">Company</h4>
                    <ul class="mt-3 space-y-2.5 text-sm">
                        <li><a href="mailto:hello@linknest.test" class="text-gray-500 hover:text-gray-900 transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} LinkNest. All rights reserved.</p>
                <p class="text-xs text-gray-400">Built with Laravel &amp; Livewire.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
