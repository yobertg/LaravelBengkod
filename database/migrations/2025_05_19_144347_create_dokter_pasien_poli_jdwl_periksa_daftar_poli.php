<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterPasienPoliJdwlPeriksaDaftarPoli extends Migration
{
    public function up()
    {
        // Create poli table
        Schema::create('poli', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poli', 25);
            $table->text('keterangan');
            $table->timestamps();
        });

        // Create dokter table
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('alamat', 255);
            $table->string('no_hp', 50);
            $table->unsignedBigInteger('id_poli');
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
            $table->timestamps();
        });

        // Create pasien table
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('alamat', 255);
            $table->string('no_ktp', 255);
            $table->string('no_hp', 50);
            $table->string('no_rm', 25);
            $table->timestamps();
        });

        // Create jadwal_periksa table
        Schema::create('jadwal_periksa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokter');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade');
            $table->timestamps();
        });

        // Create daftar_poli table
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_jadwal');
            $table->text('keluhan');
            $table->integer('no_antrian')->unsigned();
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal_periksa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daftar_poli');
        Schema::dropIfExists('jadwal_periksa');
        Schema::dropIfExists('pasien');
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('poli');
    }
}