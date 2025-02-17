<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLineaDocuToTarifaproductos extends Migration
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
            $table->integer('documento')->nullable();
            $table->integer('linea')->nullable();
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
            $table->dropColumn('documento');
            $table->dropColumn('linea');
        });
    }
}
