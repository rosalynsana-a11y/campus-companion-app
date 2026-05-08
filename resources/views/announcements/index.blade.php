<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Announcements') }}
            </h2>
            @if(Auth::user()->usertype == 'admin')
                <button onclick="document.getElementById('add-announcement-modal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Add Announcement
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
                <!-- Simple Modal/Form for Adding Announcement -->
                <div id="add-announcement-modal" class="hidden mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add New Announcement</h3>
                        <form action="{{ route('announcements.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <x-input-label for="title" value="Title" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="category" value="Category" />
                                    <select name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="General">General</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Event">Event</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="content" value="Content" />
                                    <textarea name="content" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('add-announcement-modal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Save Announcement</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="space-y-6">
                @forelse ($announcements as $announcement)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold">{{ $announcement->title }}</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->category == 'Urgent' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $announcement->category }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $announcement->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <p class="mt-4 text-gray-600">
                                {{ $announcement->content }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-12 text-center text-gray-400">
                            <div class="text-5xl mb-4">📢</div>
                            <h3 class="text-lg font-semibold">No Announcements Yet</h3>
                            <p class="text-sm mt-1">Check back later for updates from the admin.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
