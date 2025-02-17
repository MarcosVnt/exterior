<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMermasToPresupuestosDetalleTable extends Migration
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
            $table->decimal('mermas', 11, 3)->nullable();

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
            $table->dropColumn('mermas');

        });
    }
}
