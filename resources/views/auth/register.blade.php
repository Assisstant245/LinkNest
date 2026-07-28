<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create your account · LinkNest</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased text-gray-900">

<div class="min-h-screen grid lg:grid-cols-2 bg-gray-50">

    {{-- LEFT SIDE --}}
    <div
        class="hidden lg:flex relative items-center overflow-hidden bg-gray-900 bg-cover bg-center mt-5"
        style="background-image: url('{{ asset('images/register.png') }}');">

        {{-- Overlay for text legibility --}}
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-950/90 via-indigo-950/50 to-indigo-950/10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-indigo-950/80 via-transparent to-transparent"></div>

        <div class="relative text-white px-12 py-16 max-w-lg">

            {{-- Heading --}}
            <h2 class="text-5xl font-bold leading-tight drop-shadow-lg">
                Everything
                <br>
                in One Link
            </h2>

            <p class="mt-5 text-lg text-indigo-100 leading-8 drop-shadow">
                Share your links, social media, videos, portfolio,
                and everything you create using one beautiful
                LinkNest page.
            </p>

        </div>

    </div>

    {{-- RIGHT SIDE --}}
    <div class="flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-md">

            <div class="max-w-md mx-auto">

                {{-- Heading --}}
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 via-violet-600 to-pink-600 bg-clip-text text-transparent">
                        Create your account
                    </h1>

                    <p class="mt-2 text-gray-500">
                        Join LinkNest and create your beautiful bio page.
                    </p>
                </div>

                {{-- Google Button --}}
                <a href="{{ route('auth.google.redirect') }}"
                    class="flex items-center justify-center gap-3 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                        <path fill="#FFC107"
                            d="M43.6 20.5H42V20H24v8h11.3C33.6 32.7 29.2 36 24 36c-6.6 0-12-5.4-12-12S17.4 12 24 12c3 0 5.8 1.1 7.9 2.9l5.7-5.7C34.1 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z" />
                        <path fill="#FF3D00"
                            d="M6.3 14.7l6.6 4.8C14.7 15.4 19 12 24 12c3 0 5.8 1.1 7.9 2.9l5.7-5.7C34.1 6.1 29.3 4 24 4c-7.7 0-14.3 4.3-17.7 10.7z" />
                        <path fill="#4CAF50"
                            d="M24 44c5.2 0 10-2 13.5-5.2l-6.2-5.2C29.2 35.3 26.7 36 24 36c-5.2 0-9.6-3.3-11.3-8l-6.6 5.1C9.5 39.6 16.2 44 24 44z" />
                        <path fill="#1976D2"
                            d="M43.6 20.5H42V20H24v8h11.3c-1.1 3.1-3.3 5.5-6.2 6.9l6.2 5.2C39.6 36.2 44 30.7 44 24c0-1.3-.1-2.4-.4-3.5z" />
                    </svg>
                    Continue with Google
                </a>

                {{-- Divider --}}
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-4 text-sm text-gray-500">
                            or continue with email
                        </span>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input name="name" id="name" class="block w-full mt-1 rounded-xl"
                            type="text" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input name="email" id="email" class="block w-full mt-1 rounded-xl"
                            type="email" value="{{ old('email') }}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input name="password" id="password" class="block w-full mt-1 rounded-xl"
                            type="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <x-input-label for="password_confirmation" value="Confirm Password" />
                        <x-text-input name="password_confirmation" id="password_confirmation"
                            class="block w-full mt-1 rounded-xl" type="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- Register Button --}}
                    <x-primary-button class="w-full justify-center h-12 rounded-xl text-base">
                        Create Account
                    </x-primary-button>
                </form>

                {{-- Login --}}
                <p class="mt-6 text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                        Sign in
                    </a>
                </p>

                {{-- Terms --}}
                <p class="mt-6 text-center text-xs leading-6 text-gray-400">
                    By creating an account you agree to our
                    <a href="#" class="text-indigo-600 hover:underline">Terms</a>
                    and
                    <a href="#" class="text-indigo-600 hover:underline">Privacy Policy</a>
                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>
