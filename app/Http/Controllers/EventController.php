<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Asumsikan kita memiliki model Event
        return view('events.index', compact('events'));
    }
}
