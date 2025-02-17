<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoFinToObraManoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obra_mano', function (Blueprint $table) {
            //
            $table->boolean('fin')->default(false);
            $table->string('tipo_trabajo');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obra_mano', function (Blueprint $table) {
            //
            $table->dropColumn('fin');
            $table->dropColumn('tipo_trabajo');

        });
    }
}
