<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('obats')->insert([
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet 500 mg',
                'harga' => 2000,
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul 500 mg',
                'harga' => 3000,
            ],
            [
                'nama_obat' => 'Vitamin C',
                'kemasan' => 'Tablet 100 mg',
                'harga' => 1500,
            ],
        ]);
    }
}
