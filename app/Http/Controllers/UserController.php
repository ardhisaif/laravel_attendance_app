<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create'); // Pastikan nama file sesuai dengan nama yang Anda buat
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:355',
            'kelompok_id' => 'required|integer',
            'category_of_age' => 'required|integer',
        ]);

        // Generate user ID
        $kelompokId = $request->kelompok_id;
        $categoryOfAge = $request->category_of_age;
        $dateNow = time(); // Menggunakan timestamp saat ini

        // Menghasilkan ID
        $userId = "{$kelompokId}{$categoryOfAge}{$dateNow}";
        echo "User ID: $userId\n";

        // Buat pengguna baru
        User::create([
            'id' => $userId,
            'name' => $request->name,
            'kelompok_id' => $request->kelompok_id,
            'category_of_age' => $request->category_of_age,
            'date_of_birth' => $request->date_of_birth,
            'email' => '', // Set email default
            'password' => '', // Set password default
            'is_active' => true, // Default aktif
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function index()
    {
        $users = User::all(); // Mengambil semua data user
        $kelompoks = Kelompok::all(); // Mengambil data kelompok

        $groupedUsers = $users->groupBy('kelompok_id');

        // Kirim data user dan kelompok ke view
        return view('users.index', compact('users', 'groupedUsers', 'kelompoks'));
    }

    public function getUsersByKelompok($kelompok_id)
    {
        // Dapatkan user berdasarkan kelompok yang dipilih
        $users = User::where('kelompok_id', $kelompok_id)->get();

        // Kembalikan dalam format JSON agar bisa diproses oleh JavaScript
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $qrcode = QrCode::size(150)->generate(route('users.show', $id));
        return view('users.show', compact('user', 'qrcode'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $kelompoks = Kelompok::all(); // Ambil semua kelompok untuk dropdown
        return view('users.edit', compact('user', 'kelompoks'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'kelompok_id' => 'required|exists:kelompok,id',
            'category_of_age' => 'required|integer',
            'date_of_birth' => 'nullable|date',
        ]);

        // Temukan user berdasarkan ID dan update datanya
        $user = User::findOrFail($id);
        $user->update($request->all());

        // Redirect ke halaman detail atau list dengan pesan sukses
        return redirect()->route('users.show', $user->id)->with('success', 'User updated successfully.');
    }


}
