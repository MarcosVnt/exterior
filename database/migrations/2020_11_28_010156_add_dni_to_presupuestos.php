<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDniToPresupuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            
        
            $table->string('nombre_fiscal')->nullable();
            $table->string('dni')->nullable();
            $table->string('direccion')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('poblacion')->nullable();
            $table->string('provincia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('movil')->nullable();
            $table->string('email')->nullable();
            $table->string('observaciones')->nullable();
    
        });
    }
    
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->dropColumn('nombre_fiscal');
            $table->dropColumn('dni');
            $table->dropColumn('direccion');
            $table->dropColumn('codigo_postal');
            $table->dropColumn('poblacion');
    
            $table->dropColumn('provincia');
            $table->dropColumn('telefono');
            $table->dropColumn('movil');
            $table->dropColumn('email');
            $table->dropColumn('observaciones');
        });
    }
}
