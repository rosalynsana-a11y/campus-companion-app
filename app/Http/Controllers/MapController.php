<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $locations = \App\Models\Location::all();
        return view('map.index', compact('locations'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        \App\Models\Location::create($validated);

        return redirect()->back()->with('success', 'Location added successfully!');
    }}
