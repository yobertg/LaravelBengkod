<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ubah foreign key di jadwal_periksa
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->dropForeign(['id_dokter']);
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });

        // Ubah foreign key di daftar_poli
        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropForeign(['id_pasien']);
            $table->foreign('id_pasien')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Balik foreign key ke tabel dokter & pasien jika diperlukan
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->dropForeign(['id_dokter']);
            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade');
        });

        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropForeign(['id_pasien']);
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
        });
    }
};
