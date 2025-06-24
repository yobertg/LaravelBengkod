<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            // Tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('periksas', 'id_daftar_poli')) {
                $table->unsignedBigInteger('id_daftar_poli')->after('id')->nullable();
                $table->foreign('id_daftar_poli')->references('id')->on('daftar_poli')->onDelete('cascade');
            }

            // Drop foreign key lama
            $table->dropForeign(['id_pasien']);
            $table->dropForeign(['id_dokter']);

            // Tambahkan foreign key baru
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            // Drop foreign key baru
            $table->dropForeign(['id_daftar_poli']);
            $table->dropColumn('id_daftar_poli');

            $table->dropForeign(['id_pasien']);
            $table->dropForeign(['id_dokter']);

            // Kembalikan foreign key ke users
            $table->foreign('id_pasien')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
?>
