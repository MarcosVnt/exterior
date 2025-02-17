<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vallas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('terreno_id')->unsigned()->nullable();;
            $table->foreign('terreno_id')->references('id')
                  ->on('terrenos')->onUpdate('cascade')->onDelete('set null');
            

            $table->string('dni'); 
            $table->string('nombre'); 
            $table->string('direccion')->nullable(); 
            $table->string('poblacion')->nullable();
            $table->string('postal')->nullable();
            $table->string('provincia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->boolean('factura')->default(1); 
          
            $table->longText('observaciones')->nullable();

            $table->decimal('latitud',8,6)->nullable();
            $table->decimal('longitud',9,6)->nullable();
            $table->decimal('ancho',9,4)->nullable();
            $table->decimal('alto',9,4)->nullable();
            $table->decimal('m2',9,4)->nullable();
            $table->string('tipo')->nullable();
            $table->string('elemento')->nullable();
            $table->string('estado')->nullable();
     
                
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
        Schema::dropIfExists('vallas');
    }
}
