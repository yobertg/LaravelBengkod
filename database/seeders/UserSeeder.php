<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            // 3 Dokter
            [
                'nama' => 'Dr. Rina Maharani',
                'alamat' => 'Yogyakarta',
                'no_hp' => '08123450001',
                'id_poli' => 1,
                'email' => 'rina.dokter1@gmail.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'no_ktp' => null,
                'no_rm' => null,
            ],
            [
                'nama' => 'Dr. Andika Surya',
                'alamat' => 'Surabaya',
                'no_hp' => '08123450002',
                'id_poli' => 2,
                'email' => 'andika.dokter2@gmail.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'no_ktp' => null,
                'no_rm' => null,
            ],
            [
                'nama' => 'Dr. Melati Ayu',
                'alamat' => 'Malang',
                'no_hp' => '08123450003',
                'id_poli' => 3,
                'email' => 'melati.dokter3@gmail.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'no_ktp' => null,
                'no_rm' => null,
            ],

            // 3 Admin
            [
                'nama' => 'Admin Satu',
                'alamat' => 'Bekasi',
                'no_hp' => '08111110001',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'id_poli' => null,
                'no_ktp' => null,
                'no_rm' => null,
            ],
            [
                'nama' => 'Admin Dua',
                'alamat' => 'Depok',
                'no_hp' => '08111110002',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'id_poli' => null,
                'no_ktp' => null,
                'no_rm' => null,
            ],
            [
                'nama' => 'Admin Tiga',
                'alamat' => 'Bogor',
                'no_hp' => '08111110003',
                'email' => 'admin3@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'id_poli' => null,
                'no_ktp' => null,
                'no_rm' => null,
            ],

            // 3 Pasien
            [
                'nama' => 'Siti Aminah',
                'alamat' => 'Solo',
                'no_hp' => '08122220001',
                'email' => 'siti.pasien1@gmail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'id_poli' => null,
                'no_ktp' => '3201011111000001',
                'no_rm' => 'RM00001',
            ],
            [
                'nama' => 'Joko Prabowo',
                'alamat' => 'Semarang',
                'no_hp' => '08122220002',
                'email' => 'joko.pasien2@gmail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'id_poli' => null,
                'no_ktp' => '3201011111000002',
                'no_rm' => 'RM00002',
            ],
            [
                'nama' => 'Rani Lestari',
                'alamat' => 'Tegal',
                'no_hp' => '08122220003',
                'email' => 'rani.pasien3@gmail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'id_poli' => null,
                'no_ktp' => '3201011111000003',
                'no_rm' => 'RM00003',
            ],
        ]);
    }
}
