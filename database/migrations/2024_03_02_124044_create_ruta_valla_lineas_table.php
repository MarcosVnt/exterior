<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutaVallaLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruta_valla_lineas', function (Blueprint $table) {
            $table->increments('id');

            
            $table->integer('ruta_valla_id')->unsigned();
            $table->foreign('ruta_valla_id')->references('id')->on('ruta_vallas')->onDelete('cascade');

            $table->integer('valla_id')->unsigned();
            $table->foreign('valla_id')->references('id')->on('vallas')->onDelete('cascade');



            $table->text('descripcion')->nullable();
            $table->text('notas')->nullable();
            $table->integer('orden')->nullable();

            
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
        Schema::dropIfExists('ruta_valla_lineas');
    }
}
