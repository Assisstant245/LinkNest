<div class="max-w-7xl mx-auto h-full px-4 sm:px-6 flex items-center justify-between">
    <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0 group">
        <div class="relative w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 via-violet-500 to-pink-500 flex items-center justify-center shadow-md shadow-indigo-500/40 group-hover:shadow-indigo-500/60 transition-shadow duration-200">
            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-indigo-500 via-violet-500 to-pink-500 blur-md opacity-60 -z-10 group-hover:opacity-80 transition-opacity"></div>
            <svg viewBox="0 0 24 24" class="w-5 h-5 text-white" fill="currentColor"><path d="M9.5 14.5 14.5 9.5M8 17l-2 2a3.5 3.5 0 0 1-5-5l3-3a3.5 3.5 0 0 1 5-.2M16 7l2-2a3.5 3.5 0 0 1 5 5l-3 3a3.5 3.5 0 0 1-5 .2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <span class="font-bold text-lg bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">LinkNest</span>
    </a>

    <nav class="hidden md:flex items-center gap-1 bg-gray-50/80 border border-gray-100 rounded-full p-1">
        <a href="#features" class="text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded-full px-4 py-1.5 transition-all duration-150">Features</a>
        <a href="#showcase" class="text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded-full px-4 py-1.5 transition-all duration-150">Templates</a>
        <a href="#pricing" class="text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded-full px-4 py-1.5 transition-all duration-150">Pricing</a>
    </nav>

    <div class="flex items-center gap-2 shrink-0">
        @auth
            <a href="{{ route('builder') }}" class="inline-flex items-center justify-center font-semibold rounded-full transition-all duration-200 whitespace-nowrap text-sm px-4 py-2 bg-gradient-to-r from-indigo-500 via-violet-500 to-pink-500 text-white shadow-md shadow-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/50 hover:-translate-y-0.5">
                Go to Builder
            </a>
        @else
            <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center justify-center font-medium rounded-full transition-colors duration-150 whitespace-nowrap text-sm px-4 py-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center font-semibold rounded-full transition-all duration-200 whitespace-nowrap text-sm px-4 py-2 bg-gradient-to-r from-indigo-500 via-violet-500 to-pink-500 text-white shadow-md shadow-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/50 hover:-translate-y-0.5">
                    Get Started
                </a>
            @endif
        @endauth
    </div>
</div>
