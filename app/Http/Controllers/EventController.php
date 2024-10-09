<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Presence;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        // Ambil semua data absensi yang terkait dengan event
        $presences = Presence::where('event_id', $event->id)->get();

        return view('presences.index', compact('event', 'presences'));
    }

    // Menyimpan event baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:300',
            'date' => 'required|date',
            'category_of_age' => 'required|integer',
        ]);

        // Membuat event baru
        Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'category_of_age' => $request->category_of_age,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }
}
