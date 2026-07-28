<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in · LinkNest</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased text-gray-900">

<div class="min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-6xl rounded-3xl shadow-2xl p-6 bg-white">
    <div class="grid lg:grid-cols-2 overflow-hidden gap-5 rounded-2xl">
        {{-- LEFT SIDE --}}
        <div class="p-8 lg:p-14 flex flex-col justify-center m-5">

            {{-- Logo --}}
            <div class="flex items-center gap-3 mb-8">
                <div class="h-12 w-12 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 115.656 5.656l-1.5 1.5"/>
                    </svg>
                </div>
                <div class="m-5">
                    <h2 class="text-2xl font-bold">LinkNest</h2>
                    <p class="text-gray-500 text-sm">Welcome back 👋</p>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-emerald-600">
                    {{ session('status') }}
                </div>
            @endif

           

            
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="email" value="Email" class="text-lg"/>
                    <x-text-input
                        name="email"
                        id="email"
                        class="block w-full mt-1 rounded-xl"
                        type="email"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="password" class="mt-5" value="Password"/>
                    <x-text-input
                        name="password"
                        id="password"
                        class="block w-full mt-1 rounded-xl"
                        type="password"
                        required autocomplete="current-password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="flex justify-between items-center">
                    <label class="inline-flex items-center">
                        <input
                            name="remember"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 mt-5">
                        <span class="ml-2 mt-5 text-sm text-gray-600">Remember me</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline mt-5">
                        Forgot Password?
                    </a>
                </div>

                <x-primary-button class="w-full justify-center h-12 rounded-xl text-base mt-4">
                    Log In
                </x-primary-button>
            </form>

            <p class="mt-8 text-center text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                    Create Account
                </a>
            </p>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="hidden lg:flex relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 items-center justify-center p-12 overflow-hidden">
            <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-white/10"></div>
            <div class="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-white/10"></div>

            <div class="relative text-center text-white max-w-md">
                <img
                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80"
                    class="rounded-3xl shadow-2xl mb-8"
                    alt="LinkNest">

                <h2 class="text-4xl font-bold leading-tight">
                    One Link.
                    <br>
                    Unlimited Possibilities.
                </h2>

                <p class="mt-5 text-lg text-indigo-100">
                    Build your personal page, showcase your links,
                    grow your audience, and share everything with one
                    beautiful LinkNest profile.
                </p>
            </div>
        </div>

    </div>
</div>

</div>

</body>
</html>
