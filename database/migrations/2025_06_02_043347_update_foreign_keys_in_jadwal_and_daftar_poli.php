<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeysInJadwalAndDaftarPoli extends Migration
{
    public function up()
    {
        // Ubah foreign key pada jadwal_periksa
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->dropForeign(['id_dokter']); // hapus FK lama ke tabel dokter
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade'); // buat FK ke users
        });

        // Ubah foreign key pada daftar_poli
        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropForeign(['id_pasien']); // hapus FK lama ke tabel pasien
            $table->foreign('id_pasien')->references('id')->on('users')->onDelete('cascade'); // buat FK ke users
        });
    }

    public function down()
    {
        // Kembalikan ke foreign key awal jika rollback
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->dropForeign(['id_dokter']);
            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade');
        });

        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropForeign(['id_pasien']);
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
        });
    }
}
