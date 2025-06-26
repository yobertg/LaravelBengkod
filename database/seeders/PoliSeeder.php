<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('poli')->insert([
            [
                'nama_poli' => 'Umum',
                'keterangan' => 'Poli untuk penyakit umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Gigi',
                'keterangan' => 'Poli untuk perawatan gigi dan mulut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Mata',
                'keterangan' => 'Poli untuk perawatan mata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}