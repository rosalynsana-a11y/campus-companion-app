<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Campus Companion - ISUFST Dingle</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 text-gray-900">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            <!-- Navbar -->
            <nav class="absolute top-0 w-full flex justify-between items-center p-6 lg:px-12">
                <div class="flex items-center space-x-2">
                    <x-application-logo class="h-10 w-auto fill-current text-indigo-600" />
                    <span class="text-xl font-bold tracking-tight text-gray-800">Campus Companion</span>
                </div>
                
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">Get Started</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>

            <!-- Hero Section -->
            <main class="text-center px-6 mt-20">
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-4">
                    Your All-in-One <span class="text-indigo-600">Campus Guide</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto mb-8">
                    Stay updated with the latest announcements, view your class schedules, and navigate ISUFST Dingle Campus with ease.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto mt-12">
                    <!-- Feature 1 -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                        <div class="text-3xl mb-3">📅</div>
                        <h3 class="font-bold text-gray-800">Class Schedules</h3>
                        <p class="text-sm text-gray-500 mt-2 text-center">Never miss a class with our real-time schedule viewer.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                        <div class="text-3xl mb-3">📢</div>
                        <h3 class="font-bold text-gray-800">Announcements</h3>
                        <p class="text-sm text-gray-500 mt-2 text-center">Get the latest news and urgent alerts from the campus.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                        <div class="text-3xl mb-3">🎉</div>
                        <h3 class="font-bold text-gray-800">Campus Events</h3>
                        <p class="text-sm text-gray-500 mt-2 text-center">Stay in the loop with upcoming school activities.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center">
                        <div class="text-3xl mb-3">📍</div>
                        <h3 class="font-bold text-gray-800">Campus Map</h3>
                        <p class="text-sm text-gray-500 mt-2 text-center">Find your way around campus with our interactive map.</p>
                    </div>
                </div>

                <div class="mt-12 text-sm text-gray-400">
                    Built for ISUFST Dingle Campus &copy; 2026
                </div>
            </main>

        </div>
    </body>
</html>
