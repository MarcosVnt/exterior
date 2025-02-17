<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPiezasLineaToTarifaproductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifaproductos', function (Blueprint $table) {
            //
            $table->decimal('bultos', 12, 3)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifaproductos', function (Blueprint $table) {
            //
            $table->dropColumn('bultos');

        });
    }
}
