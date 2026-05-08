<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = \App\Models\Event::orderBy('event_date')->get();
        $locations = \App\Models\Location::orderBy('name')->get();
        return view('events.index', compact('events', 'locations'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        \App\Models\Event::create($validated);

        return redirect()->back()->with('success', 'Event added successfully!');
    }}
