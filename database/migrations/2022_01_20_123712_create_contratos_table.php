<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ejercicio');
            $table->integer('numero');

            $table->integer('agencia_id')->unsigned()->nullable();
            $table->foreign('agencia_id')->references('id')
                  ->on('agencias')->onUpdate('cascade')->onDelete('set null');
            
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')
                  ->on('clientes')->onUpdate('cascade')->onDelete('set null');
                  
            $table->integer('valla_id')->unsigned()->nullable();
            $table->foreign('valla_id')->references('id')
                        ->on('vallas');

            $table->string('referencia')->nullable();
            $table->string('descripcion')->nullable();

            $table->longText('observaciones')->nullable();
            
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('duracion')->nullable();
            $table->string('forma_pago')->nullable();


            $table->decimal('importe_periodo',9,4)->nullable();            
            $table->decimal('alquiler_anual',9,4)->nullable();

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
        Schema::dropIfExists('contratos');
    }
}
