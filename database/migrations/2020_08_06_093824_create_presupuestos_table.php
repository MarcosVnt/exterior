<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users');

            $table->date('fecha_presupuesto');

      
            $table->string('cliente_codigo',20)->nullable();
            $table->string('cliente_descripcion')->nullable();

            $table->string('trabajo_descripcion');
            $table->string('gestor')->nullable();
            $table->string('contacto')->nullable();
            $table->date('fecha_entrega')->nullable();

            $table->string('referencia_pedido')->nullable();
            
      

            $table->string('estado')->nullable();

            //destub
            $table->string('destino_referencia')->nullable();
            $table->string('tipo_envio')->nullable();
            $table->string('opcion_envio')->nullable();
            $table->string('fecha_envio')->nullable();
            $table->string('direccion_envio')->nullable();
            $table->string('contacto_envio')->nullable();

            //ficheros
            $table->string('ruta_ficheros')->nullable();
            $table->string('ruta_imagenes')->nullable();
                  

            $table->decimal('montaje', 11, 2)->nullable();

            $table->decimal('subcontratado', 11, 2)->nullable();
            $table->decimal('gastos', 11, 2)->nullable();
            $table->decimal('beneficios', 11, 3)->nullable();

            $table->decimal('costes', 11, 2)->nullable();        

            $table->decimal('importefinal', 11, 2)->nullable();        

            $table->date('fecha_revision')->nullable();
            $table->string('revision')->nullable();

            $table->date('fecha_permiso')->nullable();
            $table->string('permiso')->nullable();


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
        Schema::dropIfExists('presupuestos');
    }
}
