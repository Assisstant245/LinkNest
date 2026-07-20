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
    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
        <a href="{{ route('templates') }}" class="flex items-center gap-2 mb-8">
            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-sm shadow-indigo-500/30">
                <svg viewBox="0 0 24 24" class="w-5 h-5 text-white" fill="currentColor"><path d="M9.5 14.5 14.5 9.5M8 17l-2 2a3.5 3.5 0 0 1-5-5l3-3a3.5 3.5 0 0 1 5-.2M16 7l2-2a3.5 3.5 0 0 1 5 5l-3 3a3.5 3.5 0 0 1-5 .2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <span class="font-semibold text-lg text-gray-900">LinkNest</span>
        </a>

        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-2xl shadow-sm px-6 py-7">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>
</html>
