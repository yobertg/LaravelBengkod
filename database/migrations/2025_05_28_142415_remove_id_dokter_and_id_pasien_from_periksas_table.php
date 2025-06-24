<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            // Drop foreign keys terlebih dahulu
            if (Schema::hasColumn('periksas', 'id_dokter')) {
                $table->dropForeign(['id_dokter']);
                $table->dropColumn('id_dokter');
            }

            if (Schema::hasColumn('periksas', 'id_pasien')) {
                $table->dropForeign(['id_pasien']);
                $table->dropColumn('id_pasien');
            }
        });
    }

    public function down(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            // Tambahkan kembali kolom dan foreign key jika dibatalkan
            $table->unsignedBigInteger('id_dokter')->nullable();
            $table->unsignedBigInteger('id_pasien')->nullable();

            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
        });
    }
};
?>
