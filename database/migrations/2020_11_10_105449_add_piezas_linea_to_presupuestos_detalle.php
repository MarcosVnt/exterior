<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPiezasLineaToPresupuestosDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuestos_detalle', function (Blueprint $table) {
            //
            
        //  $table->decimal('bultos', 12, 3)->nullable();
         // $table->integer('linea')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuestos_detalle', function (Blueprint $table) {
            //
            $table->dropColumn('bultos');
            $table->dropColumn('linea');
        });
    }
}
