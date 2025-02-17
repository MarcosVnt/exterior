<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_componentes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idpresupuesto')->unsigned();
            $table->foreign('idpresupuesto')->references('id')->on('presupuestos')->onDelete('cascade');

            $table->integer('idpresupuestolinea')->unsigned();
            $table->foreign('idpresupuestolinea')->references('id')->on('presupuestos_detalle')->onDelete('cascade');
         
          /*   $table->integer('idarticulo')->unsigned();
            $table->foreign('idarticulo')->references('id')->on('articulos');
           */
          $table->string('articulo_principal', 50)->nullable();
          $table->string('articulo', 50)->nullable();
          $table->string('descripcion', 256)->nullable();
          $table->string('proveedor', 100)->nullable();
          
          $table->decimal('ancho', 15,3)->nullable();
          $table->decimal('longitud', 15,3)->nullable();
          $table->decimal('m2', 15,3)->nullable();
          $table->string('tipounidad', 50)->nullable();

          
          $table->decimal('cantidad', 13, 3)->nullable();
          
        //  $table->integer('cantidad')->nullable();

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
        Schema::dropIfExists('presupuesto_componentes');
    }
}
