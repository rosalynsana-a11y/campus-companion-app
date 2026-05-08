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
    }}
