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
    }}
