<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostesToTerrenos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terrenos', function (Blueprint $table) {
            //
           
            $table->string('duracion')->nullable();
            $table->string('forma_pago')->nullable();

            $table->decimal('importe_periodo',9,4)->nullable();            
            $table->decimal('alquiler_anual',9,4)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terrenos', function (Blueprint $table) {
            //
            $table->dropColumn('duracion');
            $table->dropColumn('forma_pago');
            
            $table->dropColumn('importe_periodo');
            $table->dropColumn('alquiler_anual');

        });
    }
}
