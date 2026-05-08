<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Campus Map') }}
            </h2>
            @if(Auth::user()->usertype == 'admin')
                <button onclick="document.getElementById('add-location-modal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Add Map Pin
                </button>
            @endif
        </div>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(Auth::user()->usertype == 'admin')
                <!-- Simple Modal/Form for Adding Location -->
                <div id="add-location-modal" class="hidden mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add New Map Location</h3>
                        <p class="text-sm text-gray-600 mb-4">💡 <strong>Tip:</strong> You can click anywhere on the map below to automatically fill the Latitude and Longitude fields.</p>
                        <form action="{{ route('map.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <x-input-label for="name" value="Location Name" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="latitude" value="Latitude" />
                                    <x-text-input id="latitude" name="latitude" type="text" placeholder="e.g. 11.00112" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="longitude" value="Longitude" />
                                    <x-text-input id="longitude" name="longitude" type="text" placeholder="e.g. 122.66319" class="mt-1 block w-full" required />
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label for="description" value="Description" />
                                    <textarea name="description" rows="2" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                </div>
                                <div class="md:col-span-2 flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('add-location-modal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Save Location</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="map" style="height: 500px;" class="rounded-lg shadow-inner"></div>
                </div>
            </div>

            <!-- Location List Below Map -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📍 Campus Locations</h3>
                    @forelse($locations as $location)
                        <div class="flex justify-between items-start py-3 border-b last:border-0">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $location->name }}</p>
                                <p class="text-sm text-gray-500">{{ $location->description }}</p>
                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap ml-4">{{ $location->latitude }}, {{ $location->longitude }}</span>
                        </div>
                    @empty
                        <div class="text-center text-gray-400 py-8">
                            <div class="text-4xl mb-3">🗺️</div>
                            <p class="font-semibold">No pins on the map yet.</p>
                            @if(Auth::user()->usertype == 'admin')
                                <p class="text-sm mt-1">Click "+ Add Map Pin" then click anywhere on the map to place a pin.</p>
                            @else
                                <p class="text-sm mt-1">The admin will add campus locations here.</p>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map centered on ISUFST Dingle Campus
            const map = L.map('map').setView([11.00112, 122.66319], 18);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const locations = @json($locations);

            locations.forEach(location => {
                L.marker([location.latitude, location.longitude])
                    .addTo(map)
                    .bindPopup(`<b>${location.name}</b><br>${location.description}`);
            });

            // Click to select location on map (Admin only)
            @if(Auth::user()->usertype == 'admin')
                map.on('click', function(e) {
                    const modal = document.getElementById('add-location-modal');
                    if (!modal.classList.contains('hidden')) {
                        document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
                        document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
                        
                        // Temporary marker to show selected spot
                        if (window.tempMarker) {
                            map.removeLayer(window.tempMarker);
                        }
                        window.tempMarker = L.marker(e.latlng, {
                            icon: L.icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            })
                        }).addTo(map).bindPopup("Selected Spot").openPopup();
                    }
                });
            @endif
        });
    </script>
</x-app-layout>
