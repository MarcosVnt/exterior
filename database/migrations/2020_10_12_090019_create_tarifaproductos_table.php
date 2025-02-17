<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifaproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifaproductos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('articulo', 50)->nullable();
            $table->string('componente', 50)->nullable();
            
            $table->string('tipo', 50)->nullable();
            
            $table->string('descripcion', 256)->nullable();
            $table->string('proveedor', 100)->nullable();
            
            $table->decimal('ancho', 15,3)->nullable();
            $table->decimal('longitud', 15,3)->nullable();
            $table->decimal('m2', 15,3)->nullable();
            $table->string('tipounidad', 50)->nullable();
  
            //$table->integer('cantidad')->nullable();
            $table->decimal('cantidad', 13, 3)->nullable();

  
              $table->decimal('precio', 11, 2)->nullable();
              
              $table->decimal('descuento', 11, 2)->nullable();
  
              $table->decimal('preciofinal', 11, 2)->nullable();
  
              $table->decimal('montaje', 11, 2)->nullable();
  
              $table->decimal('subcontratado', 11, 2)->nullable();
              $table->decimal('gastos', 11, 2)->nullable();
              $table->decimal('beneficios', 11, 3)->nullable();
  
              $table->decimal('mermas', 11, 3)->nullable();
  
              $table->decimal('costes', 11, 2)->nullable();
  
              $table->decimal('importefinal', 11, 2)->nullable();        
  
              $table->string('comentarios', 50)->nullable();
            
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
        Schema::dropIfExists('tarifaproductos');
    }
}
