<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = \App\Models\Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
        ]);

        \App\Models\Announcement::create($validated);

        return redirect()->back()->with('success', 'Announcement added successfully!');
    }}
