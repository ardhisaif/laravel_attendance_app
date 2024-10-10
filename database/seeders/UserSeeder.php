<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Ahmad Saifudin Ardhiansyah', 'kelompok_id' => 2, 'is_active' => true, 'category_of_age' => 4, 'id' => '1'],
            ['name' => 'Hananan Aflach Al-azizi', 'kelompok_id' => 2, 'is_active' => true, 'category_of_age' => 4, 'id' => '2'],
            ['name' => 'Heppy Ratna Utami', 'kelompok_id' => 2, 'is_active' => true, 'category_of_age' => 4, 'id' => '3'],
            ['name' => 'Humayra Delova Salsabila Putri', 'kelompok_id' => 2, 'is_active' => true, 'category_of_age' => 4, 'id' => '4'],
            ['name' => 'Jerome Ocean Ferian Crystagana', 'kelompok_id' => 2, 'is_active' => true, 'category_of_age' => 4, 'id' => '5'],
            ['name' => 'Fathul Romadon', 'kelompok_id' => 3, 'is_active' => true, 'category_of_age' => 4, 'id' => '6'],
            ['name' => 'Afiza', 'kelompok_id' => 3, 'is_active' => true, 'category_of_age' => 4, 'id' => '7'],
            ['name' => 'Alfin', 'kelompok_id' => 3, 'is_active' => true, 'category_of_age' => 4, 'id' => '8'],
            ['name' => 'Aziz', 'kelompok_id' => 3, 'is_active' => true, 'category_of_age' => 4, 'id' => '9'],
            ['name' => 'Andika', 'kelompok_id' => 3, 'is_active' => true, 'category_of_age' => 4, 'id' => '10'],
            ['name' => 'Ana', 'kelompok_id' => 1, 'is_active' => true, 'category_of_age' => 4, 'id' => '11'],
            ['name' => 'Anggun', 'kelompok_id' => 1, 'is_active' => true, 'category_of_age' => 4, 'id' => '12'],
            ['name' => 'Ani', 'kelompok_id' => 1, 'is_active' => true, 'category_of_age' => 4, 'id' => '13'],
            ['name' => 'Anip', 'kelompok_id' => 1, 'is_active' => true, 'category_of_age' => 4, 'id' => '14'],
            ['name' => 'Arvin', 'kelompok_id' => 1, 'is_active' => true, 'category_of_age' => 4, 'id' => '15'],
            ['name' => 'M Nurhasim', 'kelompok_id' => 6, 'is_active' => true, 'category_of_age' => 4, 'id' => '16'],
            ['name' => 'Putra Dirgantara', 'kelompok_id' => 6, 'is_active' => true, 'category_of_age' => 4, 'id' => '17'],
            ['name' => 'Rizki Aditya', 'kelompok_id' => 6, 'is_active' => true, 'category_of_age' => 4, 'id' => '18'],
            ['name' => 'Rizky (mt)', 'kelompok_id' => 6, 'is_active' => true, 'category_of_age' => 4, 'id' => '19'],
            ['name' => 'Royan Aris Sudigno', 'kelompok_id' => 6, 'is_active' => true, 'category_of_age' => 4, 'id' => '20'],
            ['name' => 'Zulfikar', 'kelompok_id' => 5, 'is_active' => true, 'category_of_age' => 4, 'id' => '21'],
            ['name' => 'Illyasa At Tariq (attar mt)', 'kelompok_id' => 5, 'is_active' => true, 'category_of_age' => 4, 'id' => '22'],
            ['name' => 'Muhammad Fadilah Putra', 'kelompok_id' => 5, 'is_active' => true, 'category_of_age' => 4, 'id' => '23'],
            ['name' => 'Muhammad Adam Prasetya', 'kelompok_id' => 5, 'is_active' => true, 'category_of_age' => 4, 'id' => '24'],
            ['name' => 'Sava', 'kelompok_id' => 5, 'is_active' => true, 'category_of_age' => 4, 'id' => '25'],
            ['name' => 'M Anggara Afif A', 'kelompok_id' => 7, 'is_active' => true, 'category_of_age' => 4, 'id' => '26'],
            ['name' => 'Mario Brossinanda', 'kelompok_id' => 7, 'is_active' => true, 'category_of_age' => 4, 'id' => '27'],
            ['name' => 'Muhammad Aril F', 'kelompok_id' => 7, 'is_active' => true, 'category_of_age' => 4, 'id' => '28'],
            ['name' => 'Muhammad Bagus Ichwanto', 'kelompok_id' => 7, 'is_active' => true, 'category_of_age' => 4, 'id' => '29'],
            ['name' => 'Nicko Asaddulloh', 'kelompok_id' => 7, 'is_active' => true, 'category_of_age' => 4, 'id' => '30'],
            ['name' => 'Melinda', 'kelompok_id' => 4, 'is_active' => true, 'category_of_age' => 4, 'id' => '31'],
            ['name' => 'Melisa', 'kelompok_id' => 4, 'is_active' => true, 'category_of_age' => 4, 'id' => '32'],
            ['name' => 'Muhammad Raihan Majid', 'kelompok_id' => 4, 'is_active' => true, 'category_of_age' => 4, 'id' => '33'],
            ['name' => 'Muhammad Yudistira Amanulloh', 'kelompok_id' => 4, 'is_active' => true, 'category_of_age' => 4, 'id' => '34'],
            ['name' => 'Neo', 'kelompok_id' => 4, 'is_active' => true, 'category_of_age' => 4, 'id' => '35']
        ]);
    }
}
