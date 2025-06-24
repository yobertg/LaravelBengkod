<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('pasien');
    }

    public function down(): void
    {
        // Optional: Anda bisa mengembalikan definisi tabel jika ingin rollback
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('alamat', 255);
            $table->string('no_hp', 50);
            $table->unsignedBigInteger('id_poli');
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('alamat', 255);
            $table->string('no_ktp', 255);
            $table->string('no_hp', 50);
            $table->string('no_rm', 25);
            $table->timestamps();
        });
    }
};
