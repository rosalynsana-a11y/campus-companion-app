<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Class Schedule') }}
            </h2>
            @if(Auth::user()->usertype == 'admin')
                <button onclick="document.getElementById('add-schedule-modal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Add Schedule
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
                <!-- Simple Modal/Form for Adding Schedule -->
                <div id="add-schedule-modal" class="hidden mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add New Class Schedule</h3>
                        <form action="{{ route('schedules.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="subject_name" value="Subject Name" />
                                    <x-text-input id="subject_name" name="subject_name" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="subject_code" value="Subject Code" />
                                    <x-text-input id="subject_code" name="subject_code" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="day_of_week" value="Day" />
                                    <select name="day_of_week" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="start_time" value="Start Time" />
                                    <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="end_time" value="End Time" />
                                    <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="room" value="Room" />
                                    <x-text-input id="room" name="room" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div class="md:col-span-2 flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('add-schedule-modal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Save Schedule</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($schedules as $schedule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $schedule->subject_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->subject_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->day_of_week }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ date('h:i A', strtotime($schedule->start_time)) }} - {{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->room }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <div class="text-4xl mb-3">📚</div>
                                        <p class="font-semibold">No schedules added yet.</p>
                                        <p class="text-sm mt-1">The admin will add class schedules here.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
