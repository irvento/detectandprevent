<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DetectandPrevent | Advanced Web Security Solutions</title>
        <meta name="description" content="Protect your web applications from brute-force attacks, DDoS, SQL injection and other security threats with our advanced security solutions.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔒</text></svg>">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                .gradient-bg {
                    background: linear-gradient(135deg, #FF2D20 0%, #FF6B6B 100%);
                }
                .feature-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                }
            </style>
        @endif
    </head>
    <body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-sm fixed w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <svg class="h-8 w-8 text-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">Detectand<span class="text-[#FF2D20]">Prevent</span></span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <nav class="flex space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-[#FF2D20] dark:text-gray-300 dark:hover:text-white transition duration-150">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-[#FF2D20] dark:text-gray-300 dark:hover:text-white transition duration-150">
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 px-4 py-2 rounded-md text-sm font-medium text-white bg-[#FF2D20] hover:bg-[#E02420] transition duration-150">
                                            Get Started
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative pt-24 pb-20 px-4 sm:px-6 lg:pt-32 lg:pb-28 lg:px-8">
            <div class="absolute inset-0">
                <div class="bg-white h-1/3 sm:h-2/3 dark:bg-gray-900"></div>
            </div>
            <div class="relative max-w-7xl mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl dark:text-white">
                        <span class="block">Secure your web</span>
                        <span class="block text-[#FF2D20]">applications with confidence</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl dark:text-gray-300">
                        Advanced protection against brute-force attacks, DDoS, SQL injection and other security threats.
                    </p>
                    <div class="mt-10 sm:flex sm:justify-center">
                        <div class="rounded-md shadow">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF2D20] hover:bg-[#E02420] md:py-4 md:text-lg md:px-10 transition duration-150">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF2D20] hover:bg-[#E02420] md:py-4 md:text-lg md:px-10 transition duration-150">
                                    Get started for free
                                </a>
                            @endauth
                        </div>
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                            <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-[#FF2D20] bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition duration-150 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-12 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-[#FF2D20] font-semibold tracking-wide uppercase">Security Features</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        Comprehensive protection for your applications
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto dark:text-gray-300">
                        Our solution provides multiple layers of security to keep your data safe.
                    </p>
                </div>

                <div class="mt-10">
                    <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <!-- Feature 1 -->
                        <div class="feature-card relative bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out dark:bg-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#FF2D20] text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-lg leading-6 font-medium text-gray-900 dark:text-white">Brute-force Protection</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-500 dark:text-gray-300">
                                Laravel's authentication system includes login throttling, which blocks repeated failed login attempts for a period of time. This effectively reduces the risk of brute-force attacks by limiting the number of guesses an attacker can make.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="feature-card relative bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out dark:bg-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#FF2D20] text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-lg leading-6 font-medium text-gray-900 dark:text-white">DDoS Mitigation</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-500 dark:text-gray-300">
                                Laravel provides built-in request throttling via middleware, allowing you to limit the number of requests a user can make within a specified time frame. This helps prevent Denial of Service (DoS) and brute-force attacks.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="feature-card relative bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out dark:bg-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#FF2D20] text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-lg leading-6 font-medium text-gray-900 dark:text-white">SQL Injection Prevention</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-500 dark:text-gray-300">
                                Laravel's Eloquent ORM uses prepared statements and parameter binding, which automatically sanitizes inputs, preventing malicious SQL injection attacks. This ensures that user-provided data cannot manipulate database queries.
                            </p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="feature-card relative bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out dark:bg-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#FF2D20] text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-lg leading-6 font-medium text-gray-900 dark:text-white">Authentication Security</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-500 dark:text-gray-300">
                                Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you're free to get started with what matters most.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="gradient-bg">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Ready to secure your application?</span>
                    <span class="block text-[#FFEEEE]">Start your free trial today.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-[#FF2D20] bg-white hover:bg-gray-50 transition duration-150">
                            Get started
                        </a>
                    </div>
                    <div class="ml-3 inline-flex rounded-md shadow">
                        <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF2D20] bg-opacity-60 hover:bg-opacity-70 transition duration-150">
                            Learn more
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white transition duration-150">
                            About
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white transition duration-150">
                            Blog
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white transition duration-150">
                            Jobs
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white transition duration-150">
                            Press
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white transition duration-150">
                            Privacy
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white transition duration-150">
                            Terms
                        </a>
                    </div>
                </nav>
                <p class="mt-8 text-center text-base text-gray-400">
                    &copy; 2023 DetectandPrevent. All rights reserved.
                </p>
            </div>
        </footer>
    </body>
</html>