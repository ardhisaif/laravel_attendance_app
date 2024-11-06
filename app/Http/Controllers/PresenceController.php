<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Event;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    // Menampilkan data presensi berdasarkan event
    public function index(Event $event)
    {
        $presences = Presence::where('event_id', $event->id)->with('user')->get();
        $kelompoks = Kelompok::all();

        return view('presences.index', compact('presences', 'event', 'kelompoks'));
    }

    // Menyimpan data presensi
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|integer',
            'description' => 'nullable|string|max:255',
        ]);

        // Cek apakah sudah ada kehadiran untuk user dan event ini
        $existingPresence = Presence::where('user_id', $request->user_id)
            ->where('event_id', $event->id)
            ->first();

        if ($existingPresence) {
            // Jika sudah ada, kirimkan error
            return redirect()->back()->withErrors(['error' => 'User has already recorded attendance for this event.']);
        }

        Presence::create([
            'user_id' => $request->user_id,
            'event_id' => $event->id,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('presences.index', $event->id)->with('success');
    }

    public function update(Request $request, $id)
    {
        $presence = Presence::findOrFail($id);

        // Jika status adalah Alpha, hapus kehadiran
        if ($request->status == 4) {
            $presence->delete();
            return redirect()->back()->with('success', 'Kehadiran berhasil dihapus.');
        }

        // Update status kehadiran
        $presence->status = $request->status;
        $presence->save();

        return redirect()->back()->with('success', 'Status kehadiran berhasil diperbarui.');
    }

    public function storeWithNewUser(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'kelompok_id' => 'required|exists:kelompok,id',
            'new_user_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            \DB::beginTransaction();

            // Buat pengguna baru
            $user = User::create([
                'name' => $request->input('new_user_name'),
                'kelompok_id' => $request->input('kelompok_id'),
            ]);

            // Catat kehadiran dengan status 'Hadir' (status: 1)
            Presence::create([
                'user_id' => $user->id,
                'status' => 1, // Status 1 untuk 'Hadir'
                'description' => $request->input('description'),
                'event_id' => $request->input('event_id') // Pastikan 'event_id' dikirim dari form
            ]);

            \DB::commit();

            // Redirect ke halaman event presensi setelah sukses
            return redirect()->route('presences.index', $request->input('event_id'))
                            ->with('success', 'User baru berhasil ditambahkan dan absensi tercatat.');

        } catch (\Exception $e) {
            \DB::rollBack();

            // Kembalikan pesan error jika gagal
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan user dan mencatat kehadiran.']);
        }
    }

}
