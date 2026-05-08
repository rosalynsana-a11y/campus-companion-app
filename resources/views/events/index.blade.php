<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Event Calendar') }}
            </h2>
            @if(Auth::user()->usertype == 'admin')
                <button onclick="document.getElementById('add-event-modal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Add Event
                </button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(Auth::user()->usertype == 'admin')
                <!-- Simple Modal/Form for Adding Event -->
                <div id="add-event-modal" class="hidden mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add New Event</h3>
                        <form action="{{ route('events.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <x-input-label for="title" value="Event Title" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="event_date" value="Date and Time" />
                                    <x-text-input id="event_date" name="event_date" type="datetime-local" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="location" value="Venue (Campus Location)" />
                                    @if($locations->count() > 0)
                                        <select name="location" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                            <option value="">-- Select a campus location --</option>
                                            @foreach($locations as $loc)
                                                <option value="{{ $loc->name }}">{{ $loc->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="mt-1 p-3 bg-yellow-50 border border-yellow-300 rounded text-sm text-yellow-700">
                                            ⚠️ No campus locations found. <a href="{{ route('map.index') }}" class="underline font-semibold">Add map pins first</a>, then come back to create events.
                                        </div>
                                        <input type="hidden" name="location" value="TBD">
                                    @endif
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label for="description" value="Description" />
                                    <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                </div>
                                <div class="md:col-span-2 flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('add-event-modal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Save Event</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($events as $event)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-lg font-bold">
                                    {{ $event->event_date->format('M d, Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $event->event_date->format('h:i A') }}
                                </div>
                            </div>
                            <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $event->description }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $event->location }}
                                </div>
                                <a href="{{ route('map.index') }}" class="text-indigo-600 hover:underline text-xs font-semibold">📍 View on Map →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-12 text-center text-gray-400">
                            <div class="text-5xl mb-4">🎉</div>
                            <h3 class="text-lg font-semibold">No Events Scheduled Yet</h3>
                            <p class="text-sm mt-1">The admin hasn't added any campus events yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
