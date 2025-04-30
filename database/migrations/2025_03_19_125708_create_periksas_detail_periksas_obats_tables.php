<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksasDetailPeriksasObatsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabel periksas
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_dokter');
            $table->dateTime('tgl_periksa');
            $table->text('catatan')->nullable();
            $table->integer('biaya_periksa')->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_pasien')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel obats
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 50);
            $table->string('kemasan', 35);
            $table->integer('harga');
            $table->timestamps();
        });

        // Tabel detail_periksas
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periksa');
            $table->unsignedBigInteger('id_obat');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_periksa')->references('id')->on('periksas')->onDelete('cascade');
            $table->foreign('id_obat')->references('id')->on('obats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_periksas');
        Schema::dropIfExists('obats');
        Schema::dropIfExists('periksas');
    }
}
