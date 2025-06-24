<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PoliDaftarPoliJadwalPasienDokterSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Seed poli table
        $poli_data = [
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
        ];
        $poli_ids = [];
        foreach ($poli_data as $data) {
            $poli_ids[] = DB::table('poli')->insertGetId($data);
        }

        // Ambil user dokter dan pasien
        $dokter_ids = DB::table('users')->where('role', 'dokter')->pluck('id')->take(3)->toArray();
        $pasien_ids = DB::table('users')->where('role', 'pasien')->pluck('id')->take(3)->toArray();

        // Cek jika tidak cukup data
        if (count($dokter_ids) < 3 || count($pasien_ids) < 3) {
            $this->command->warn('Seeder memerlukan minimal 3 dokter dan 3 pasien di tabel users.');
            return;
        }

        // Seed jadwal_periksa table
        $jadwal_data = [
            [
                'id_dokter' => $dokter_ids[0],
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dokter' => $dokter_ids[1],
                'hari' => 'Selasa',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dokter' => $dokter_ids[2],
                'hari' => 'Rabu',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '14:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        $jadwal_ids = [];
        foreach ($jadwal_data as $data) {
            $jadwal_ids[] = DB::table('jadwal_periksa')->insertGetId($data);
        }

        // Seed daftar_poli table
        DB::table('daftar_poli')->insert([
            [
                'id_pasien' => $pasien_ids[0],
                'id_jadwal' => $jadwal_ids[0],
                'keluhan' => $faker->sentence,
                'no_antrian' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => $pasien_ids[1],
                'id_jadwal' => $jadwal_ids[1],
                'keluhan' => $faker->sentence,
                'no_antrian' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => $pasien_ids[2],
                'id_jadwal' => $jadwal_ids[2],
                'keluhan' => $faker->sentence,
                'no_antrian' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
