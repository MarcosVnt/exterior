<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerrenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrenos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('propietario_id')->unsigned()->nullable();;
            $table->foreign('propietario_id')->references('id')
                  ->on('propietarios')->onUpdate('cascade')->onDelete('set null');
            

            $table->string('dni'); 
            $table->string('nombre'); 
            $table->string('direccion'); 
            $table->string('poblacion'); 
            $table->string('postal'); 
            $table->string('provincia'); 
            $table->string('telefono');
            $table->string('email'); 
            $table->boolean('factura')->default(1); 
          
            $table->longText('observaciones')->nullable();
                  
                
            $table->boolean('baja')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terrenos');
    }
}
