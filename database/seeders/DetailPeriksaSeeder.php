<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_periksas')->insert([
            [
                'id_periksa' => 3, // Sesuaikan dengan ID di tabel periksas
                'id_obat' => 1,    // Sesuaikan dengan ID di tabel obats
            ],
            [
                'id_periksa' => 3,
                'id_obat' => 2,
            ],
            [
                'id_periksa' => 4,
                'id_obat' => 3,
            ],
        ]);
    }
}
