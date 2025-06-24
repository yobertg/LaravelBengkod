<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Fetch valid IDs from daftar_poli, pasien, and dokter tables
        $daftar_poli_ids = DB::table('daftar_poli')->pluck('id')->toArray();
        

        // Check if required data exists
        if (empty($daftar_poli_ids)) {
            throw new \Exception('Required data in daftar_poli, pasien, or dokter tables is missing. Please seed those tables first.');
        }

        // Ensure we have valid IDs to use (fall back to first available IDs if 1 or 3 are not present)
       
        $id_daftar_poli = $daftar_poli_ids[0]; // Use the first available daftar_poli ID

        DB::table('periksas')->insert([
            [
                'id_daftar_poli' => $id_daftar_poli,
                'tgl_periksa' => '2025-03-20 10:00:00',
                'catatan' => 'Pasien mengalami demam tinggi dan sakit kepala.',
                'biaya_periksa' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_daftar_poli' => $daftar_poli_ids[1] ?? $id_daftar_poli, // Use second ID if available, else fallback
                'tgl_periksa' => '2025-03-22 14:00:00',
                'catatan' => 'Keluhan batuk berdahak dan pilek.',
                'biaya_periksa' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}