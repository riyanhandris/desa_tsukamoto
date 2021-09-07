<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenilaianColumnAtNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->float('hasil_z', 4, 3)->after('keluarga')->nullable();
            $table->float('tidak_layak', 4, 3)->after('hasil_z')->nullable();
            $table->float('layak', 4, 3)->after('tidak_layak')->nullable();
            $table->string('blt')->after('layak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropColumn('hasil_z');
            $table->dropColumn('tidak_layak');
            $table->dropColumn('layak');
            $table->dropColumn('blt');
        });
    }
}
