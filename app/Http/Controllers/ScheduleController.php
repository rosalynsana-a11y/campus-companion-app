<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = \App\Models\Schedule::orderBy('day_of_week')->orderBy('start_time')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:255',
            'day_of_week' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string|max:255',
        ]);

        \App\Models\Schedule::create($validated);

        return redirect()->back()->with('success', 'Schedule added successfully!');
    }}
