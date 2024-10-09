<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    // Nama tabel di database jika berbeda dari default (default: nama model dalam bentuk jamak 'kelompok')
    protected $table = 'kelompok';

    // Kolom-kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = ['name', 'description'];

    // Jika ingin menonaktifkan timestamp otomatis (created_at, updated_at)
    public $timestamps = true;

    // Relasi dengan model User (jika ada)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
