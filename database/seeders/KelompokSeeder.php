<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mendapatkan id dari "desa 2"
        $desa2 = DB::table('desa')->where('name', 'desa 2')->first();

        // Jika desa 2 ditemukan, lakukan insert ke tabel kelompok
        if ($desa2) {
            DB::table('kelompok')->insert([
                ['desa_id' => $desa2->id, 'name' => 'Kubupadi', 'created_at' => now(), 'updated_at' => now()],
                ['desa_id' => $desa2->id, 'name' => 'Tegal', 'created_at' => now(), 'updated_at' => now()],
                ['desa_id' => $desa2->id, 'name' => 'Perumnas', 'created_at' => now(), 'updated_at' => now()],
                ['desa_id' => $desa2->id, 'name' => 'Gang Suci', 'created_at' => now(), 'updated_at' => now()],
                ['desa_id' => $desa2->id, 'name' => 'Monang-maning', 'created_at' => now(), 'updated_at' => now()],
                ['desa_id' => $desa2->id, 'name' => 'Jimbaran', 'created_at' => now(), 'updated_at' => now()],
                ['desa_id' => $desa2->id, 'name' => 'Nusa Dua', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
