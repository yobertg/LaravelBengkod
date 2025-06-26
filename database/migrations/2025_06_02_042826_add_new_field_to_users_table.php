<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_poli')->after('role')->nullable();
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
            $table->string('no_ktp', 255)->after('id_poli')->nullable();
            $table->string('no_rm', 25)->after('no_ktp')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_poli']);
            $table->dropColumn(['id_poli', 'no_ktp', 'no_rm']);
        });
    }
}
