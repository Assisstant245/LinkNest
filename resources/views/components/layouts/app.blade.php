@props(['title' => 'LinkNest'])
<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · LinkNest</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-full bg-gray-50 font-sans antialiased text-gray-900">
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/70 shadow-sm">

        <div class="max-w-7xl mx-auto flex h-20 items-center justify-between px-6">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 shadow-lg shadow-indigo-500/30">

                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 115.656 5.656l-1.5 1.5" />

                    </svg>

                </div>

                <div>

                    <h1 class="text-xl font-bold text-gray-900">
                        LinkNest
                    </h1>

                    <p class="text-xs text-gray-500">
                        One Link. Unlimited Possibilities.
                    </p>

                </div>

            </a>

            {{-- Navigation --}}
            <nav class="hidden lg:flex items-center gap-2">

                @foreach ([
        'dashboard' => 'My Pages',
        'templates' => 'Templates',
        'analytics' => 'Analytics',
        'builder' => 'Builder',
        'billing' => 'Pricing',
    ] as $route => $label)
                    @if (Route::has($route))
                        <a href="{{ route($route) }}" @class([
                            'rounded-xl px-4 py-2 text-sm font-medium transition',
                            request()->routeIs($route)
                                ? 'bg-indigo-600 text-white shadow'
                                : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-600',
                        ])>

                            {{ $label }}

                        </a>
                    @endif
                @endforeach

            </nav>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">

                @guest

                    <a href="{{ route('login') }}"
                        class="rounded-xl px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">

                        Sign In

                    </a>

                    <a href="{{ route('register') }}"
                        class="rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2 text-sm font-semibold text-white shadow-lg hover:opacity-95">

                        Get Started

                    </a>
                @else
                    <div class="relative" x-data="{ open: false }">

                        <button @click="open=!open" @click.outside="open=false"
                            class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-3 py-2 hover:bg-gray-50">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-sm font-bold text-white">

                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                            </div>

                            <div class="text-left">

                                <p class="text-sm font-semibold">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    My Account
                                </p>

                            </div>

                        </button>

                        <div x-show="open" x-transition
                            class="absolute right-0 mt-3 w-56 rounded-2xl border border-gray-200 bg-white shadow-xl">

                            <a href="{{ route('profile') }}" class="block px-5 py-3 hover:bg-gray-50">

                                Profile

                            </a>

                            <a href="{{ route('dashboard') }}" class="block px-5 py-3 hover:bg-gray-50">

                                Dashboard

                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button class="block w-full px-5 py-3 text-left hover:bg-gray-50">

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                @endguest

            </div>

        </div>

    </header>
    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
