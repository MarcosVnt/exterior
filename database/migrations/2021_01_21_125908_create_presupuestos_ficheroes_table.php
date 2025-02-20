<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosFicheroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos_ficheroes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('presupuesto_id')->unsigned()->nullable();
            $table->foreign('presupuesto_id')->references('id')
                  ->on('presupuestos')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
      
            $table->string('nombre')->nullable();
            $table->text('texto')->nullable();
            $table->string('slug')->unique();




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
        Schema::dropIfExists('presupuestos_ficheroes');
    }
}
