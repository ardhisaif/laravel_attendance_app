<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelompok;
use Illuminate\Http\Request;

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
            'date_of_birth' => 'required|date',
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

        // Kirim data user dan kelompok ke view
        return view('users.index', compact('users', 'kelompoks'));
    }
}
