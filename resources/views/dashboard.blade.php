<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->usertype == 'admin')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Admin Quick Actions -->
                    <a href="{{ route('announcements.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                        <div class="text-indigo-600 font-bold text-lg mb-2">📢 Announcements</div>
                        <p class="text-gray-600 text-sm">Post new updates for students.</p>
                    </a>
                    <a href="{{ route('schedules.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                        <div class="text-indigo-600 font-bold text-lg mb-2">📅 Class Schedules</div>
                        <p class="text-gray-600 text-sm">Manage subject times and rooms.</p>
                    </a>
                    <a href="{{ route('events.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                        <div class="text-indigo-600 font-bold text-lg mb-2">🎉 Event Calendar</div>
                        <p class="text-gray-600 text-sm">Organize upcoming campus events.</p>
                    </a>
                    <a href="{{ route('map.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                        <div class="text-indigo-600 font-bold text-lg mb-2">📍 Campus Map</div>
                        <p class="text-gray-600 text-sm">Add or update campus locations.</p>
                    </a>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600">Use the navigation bar to check your schedule, announcements, and the campus map.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
