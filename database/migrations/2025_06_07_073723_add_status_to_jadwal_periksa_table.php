<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToJadwalPeriksaTable extends Migration
{
    public function up()
    {
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('jam_selesai');
        });
    }

    public function down()
    {
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
