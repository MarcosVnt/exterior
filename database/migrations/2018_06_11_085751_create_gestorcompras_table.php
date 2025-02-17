<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGestorcomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestorcompras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('referencia', 50);
            $table->string('descripcion', 256)->nullable();
            $table->string('codigoProveedor', 256)->nullable();
            
            $table->string('proveedor', 100)->nullable();

            $table->decimal('anchura', 15,3)->nullable();
            $table->decimal('altura', 15,3)->nullable();
            $table->decimal('metros', 15,3)->nullable();
            $table->string('tipoUnidad', 50)->nullable();
  
            $table->decimal('bultos', 13, 3)->nullable();
            $table->decimal('unidades', 13, 3)->nullable();
            $table->integer('linea')->nullable();

            
            $table->decimal('dto', 11, 2)->nullable();

            $table->decimal('costeunidad', 13, 2)->nullable();
            $table->decimal('costetotal', 13, 2)->nullable();
            $table->decimal('costefinal', 13, 2)->nullable();


            
            $table->text('comentarios')->nullable();
            $table->date('fecha')->nullable();
          
           
            $table->boolean('compra')->default(1);
    
            $table->boolean('oferta')->default(1);
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
        Schema::dropIfExists('gestorcompras');
    }
}
