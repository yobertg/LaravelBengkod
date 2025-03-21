<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periksas')->insert([
            [
                'id_pasien' => 1, // Sesuaikan dengan ID pasien di tabel users
                'id_dokter' => 3, // Sesuaikan dengan ID dokter di tabel users
                'tgl_periksa' => '2025-03-20 10:00:00',
                'catatan' => 'Pasien mengalami demam tinggi dan sakit kepala.',
                'biaya_periksa' => 50000,
            ],
            [
                'id_pasien' => 1,
                'id_dokter' => 3,
                'tgl_periksa' => '2025-03-22 14:00:00',
                'catatan' => 'Keluhan batuk berdahak dan pilek.',
                'biaya_periksa' => 60000,
            ],
        ]);
    }
}
