<?php

namespace App\Http\Guest\Controllers;

use App\Http\Controllers\Controller;
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
