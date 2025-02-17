<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraManoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_mano', function (Blueprint $table) {
                $table->increments('id');
                
                $table->integer('obra_id')->unsigned()->nullable();;
                $table->foreign('obra_id')->references('id')
                      ->on('obras')->onUpdate('cascade')->onDelete('set null');
                
                $table->integer('user_id')->unsigned()->nullable();;
                $table->foreign('user_id')->references('id')
                    ->on('users')->onUpdate('cascade')->onDelete('set null');
    
                $table->string('tipo_hora',20);
                $table->dateTime('de_fecha_hora');
                $table->dateTime('a_fecha_hora');
                
                $table->string('texto',800);
                
                $table->boolean('condicion')->default(1); 
    
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
        Schema::dropIfExists('obra_mano');
    }
}
