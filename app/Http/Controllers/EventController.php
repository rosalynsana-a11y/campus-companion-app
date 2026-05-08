<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = \App\Models\Event::orderBy('event_date')->get();
        return view('events.index', compact('events'));
    }}
