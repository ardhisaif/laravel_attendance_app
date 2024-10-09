<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    // Menampilkan data presensi berdasarkan event
    public function index(Event $event)
    {
        $presences = Presence::where('event_id', $event->id)->with('user')->get();

        return view('presences.index', compact('presences', 'event'));
    }

    // Menyimpan data presensi
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|integer',
            'description' => 'nullable|string|max:255',
        ]);

        Presence::create([
            'user_id' => $request->user_id,
            'event_id' => $event->id,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('presences.index', $event->id)->with('success', 'Attendance recorded successfully.');
    }
}
