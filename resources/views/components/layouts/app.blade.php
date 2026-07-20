@props(['title' => 'LinkForge'])
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · LinkForge</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full bg-gray-50 font-sans antialiased text-gray-900">
    <header class="h-16 border-b border-gray-200 bg-white/95 backdrop-blur sticky top-0 z-20">
        <div class="max-w-7xl mx-auto h-full px-4 sm:px-6 flex items-center justify-between">
            <a href="{{ route('builder') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-sm shadow-indigo-500/30">
                    <svg viewBox="0 0 24 24" class="w-4.5 h-4.5 text-white" fill="currentColor"><path d="M9.5 14.5 14.5 9.5M8 17l-2 2a3.5 3.5 0 0 1-5-5l3-3a3.5 3.5 0 0 1 5-.2M16 7l2-2a3.5 3.5 0 0 1 5 5l-3 3a3.5 3.5 0 0 1-5 .2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <span class="font-semibold text-gray-900">LinkNest</span>
            </a>

            <nav class="flex items-center gap-1">
                @foreach(['dashboard' => 'My Pages', 'templates' => 'Templates', 'analytics' => 'Analytics', 'builder' => 'Builder', 'billing' => 'Billing'] as $routeName => $label)
                    @if(Route::has($routeName))
                        <a
                            href="{{ route($routeName) }}"
                            @class([
                                'text-sm font-medium rounded-md px-3 py-1.5 transition-colors',
                                'text-gray-900 bg-gray-100' => request()->routeIs($routeName),
                                'text-gray-500 hover:text-gray-900 hover:bg-gray-100' => !request()->routeIs($routeName),
                            ])
                        >{{ $label }}</a>
                    @endif
                @endforeach

                @auth
                    <div class="relative ml-2" x-data="{ open: false }">
                        <button type="button" @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 rounded-md pl-1 pr-2 py-1 hover:bg-gray-100 transition-colors">
                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-[11px] font-semibold text-gray-600">
                                {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <x-ui.icon name="chevron-down" class="w-3.5 h-3.5 text-gray-400" />
                        </button>

                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-44 rounded-lg border border-gray-200 bg-white shadow-lg py-1 z-30">
                            <a href="{{ route('profile') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Log out</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
