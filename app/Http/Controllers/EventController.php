<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        $event_data = [];
        foreach ($events as $event) {
            $event_data[] = [
                'title' => $event->title,
                'start' => $event->start->toDateTimeString(), 
                'end'   => $event->end->toDateTimeString(),   
            ];
        }

        return view('guest.events.index', compact('event_data'));
    }
}
