<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('desa')->insert([
            ['name' => 'desa 1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'desa 2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'desa 3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'desa 4', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
