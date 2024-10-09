<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil Seeder lainnya seperti DesaSeeder dan KelompokSeeder
        $this->call([
            DesaSeeder::class,     // Seeder untuk mengisi tabel desa
            KelompokSeeder::class, // Seeder untuk mengisi tabel kelompok
        ]);
    }
}
